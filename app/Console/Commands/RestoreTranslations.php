<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Language;
use App\Models\TranslationCategory;
use App\Models\TranslationKey;
use App\Models\TranslationValue;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RestoreTranslations extends Command
{
    protected $signature = 'translations:restore 
                          {backup? : Backup name to restore}
                          {--table= : Specific table to restore (languages,translation_categories,translation_keys,translation_values)}
                          {--list : List available backups}
                          {--force : Skip confirmation prompts}';

    protected $description = 'Restore translation tables from backup files';

    private array $tables = [
        'languages' => Language::class,
        'translation_categories' => TranslationCategory::class,
        'translation_keys' => TranslationKey::class,
        'translation_values' => TranslationValue::class,
    ];

    public function handle()
    {
        if ($this->option('list')) {
            return $this->listBackups();
        }

        $backupName = $this->argument('backup');
        
        if (!$backupName) {
            $backupName = $this->selectBackup();
            if (!$backupName) {
                return;
            }
        }

        $backupPath = storage_path("app/translation-backups/{$backupName}");
        
        if (!File::exists($backupPath)) {
            $this->error("❌ Backup '{$backupName}' not found.");
            $this->call('translations:backup', ['--list' => true]);
            return;
        }

        // Show backup information
        $this->showBackupInfo($backupPath);

        // Determine which tables to restore
        $specificTable = $this->option('table');
        if ($specificTable) {
            if (!array_key_exists($specificTable, $this->tables)) {
                $this->error("❌ Invalid table: {$specificTable}");
                $this->line('Available tables: ' . implode(', ', array_keys($this->tables)));
                return;
            }
            $tablesToRestore = [$specificTable];
        } else {
            $tablesToRestore = $this->selectTables($backupPath);
        }

        if (empty($tablesToRestore)) {
            $this->warn('No tables selected for restore.');
            return;
        }

        // Confirm restoration
        if (!$this->option('force')) {
            $this->warn('⚠️  This will overwrite existing data in the selected tables!');
            $this->table(['Table', 'Current Records', 'Backup Records'], 
                collect($tablesToRestore)->map(function ($table) use ($backupPath) {
                    $model = $this->tables[$table];
                    $currentCount = $model::count();
                    $backupData = $this->loadBackupData($backupPath, $table);
                    return [$table, $currentCount, count($backupData)];
                })->toArray()
            );

            if (!$this->confirm('Do you want to continue with the restoration?')) {
                $this->info('Restoration cancelled.');
                return;
            }
        }

        // Perform restoration
        $this->info('🔄 Starting restoration...');
        
        // Order tables by dependency (parent tables first)
        $orderedTables = $this->orderTablesByDependency($tablesToRestore);
        
        try {
            foreach ($orderedTables as $table) {
                $this->restoreTable($table, $backupPath);
            }
            
            $this->info('✅ Restoration completed successfully!');
            
        } catch (\Exception $e) {
            $this->error('❌ Restoration failed: ' . $e->getMessage());
            $this->line('Please check the error and try again.');
        }
    }

    private function selectBackup(): ?string
    {
        $backups = $this->getAvailableBackups();
        
        if ($backups->isEmpty()) {
            $this->warn('No backups available. Run translations:backup to create one.');
            return null;
        }

        $choices = $backups->pluck('name')->toArray();
        $choices[] = 'Cancel';

        $choice = $this->choice('Select a backup to restore:', $choices, count($choices) - 1);
        
        return $choice === 'Cancel' ? null : $choice;
    }

    private function selectTables(string $backupPath): array
    {
        $availableTables = [];
        
        foreach (array_keys($this->tables) as $table) {
            if (File::exists("{$backupPath}/{$table}.json")) {
                $availableTables[] = $table;
            }
        }

        if (empty($availableTables)) {
            $this->error('❌ No valid table backups found.');
            return [];
        }

        $this->info('📋 Available tables in backup:');
        foreach ($availableTables as $i => $table) {
            $data = $this->loadBackupData($backupPath, $table);
            $this->line(sprintf('%d. %s (%d records)', $i + 1, $table, count($data)));
        }

        $choices = [
            'All tables',
            'Select specific tables',
            'Cancel'
        ];

        $choice = $this->choice('What would you like to restore?', $choices, 2);

        switch ($choice) {
            case 'All tables':
                return $availableTables;
                
            case 'Select specific tables':
                $selected = [];
                foreach ($availableTables as $table) {
                    if ($this->confirm("Restore {$table}?", true)) {
                        $selected[] = $table;
                    }
                }
                return $selected;
                
            case 'Cancel':
            default:
                return [];
        }
    }

    private function restoreTable(string $table, string $backupPath): void
    {
        $this->line("  📋 Restoring {$table}...");
        
        $model = $this->tables[$table];
        $data = $this->loadBackupData($backupPath, $table);
        
        if (empty($data)) {
            $this->warn("    ⚠️  No data found for {$table}");
            return;
        }

        // Clear existing data first
        $model::query()->delete();
        
        // Restore data in chunks to handle large datasets
        $chunks = array_chunk($data, 50);
        $restored = 0;
        
        foreach ($chunks as $chunk) {
            $insertData = [];
            foreach ($chunk as $record) {
                // Get the actual fillable columns for this model to avoid including relationship data
                $modelInstance = new $model;
                $fillableColumns = array_merge($modelInstance->getFillable(), ['id', 'created_at', 'updated_at']);
                
                // Clean up the record data but preserve IDs for relationships
                $cleanRecord = collect($record)
                    ->only($fillableColumns)
                    ->except(['created_at', 'updated_at'])
                    ->toArray();
                
                // Convert datetime fields to proper MySQL format
                $cleanRecord = $this->convertDatetimeFields($cleanRecord, $modelInstance);
                
                $cleanRecord['created_at'] = now();
                $cleanRecord['updated_at'] = now();
                
                $insertData[] = $cleanRecord;
            }
            
            // Use insert instead of create for better performance with large datasets
            if (!empty($insertData)) {
                try {
                    $model::insert($insertData);
                    $restored += count($insertData);
                } catch (\Exception $e) {
                    $this->warn("    ⚠️  Failed to insert chunk: " . $e->getMessage());
                    // Try inserting records one by one
                    foreach ($insertData as $record) {
                        try {
                            $model::create($record);
                            $restored++;
                        } catch (\Exception $ex) {
                            $this->warn("    ⚠️  Failed to insert record: " . $ex->getMessage());
                        }
                    }
                }
            }
        }
        
        $this->line("    ✅ Restored {$restored} records to {$table}");
    }

    private function loadBackupData(string $backupPath, string $table): array
    {
        $filePath = "{$backupPath}/{$table}.json";
        
        if (!File::exists($filePath)) {
            return [];
        }
        
        return json_decode(File::get($filePath), true) ?: [];
    }

    private function showBackupInfo(string $backupPath): void
    {
        $metadataPath = "{$backupPath}/metadata.json";
        
        if (!File::exists($metadataPath)) {
            $this->warn('⚠️  Backup metadata not found. This might be an older backup.');
            return;
        }

        $metadata = json_decode(File::get($metadataPath), true);
        
        $this->info('📦 Backup Information:');
        $this->table(['Property', 'Value'], [
            ['Name', $metadata['backup_name']],
            ['Created', Carbon::parse($metadata['created_at'])->format('Y-m-d H:i:s')],
            ['Age', Carbon::parse($metadata['created_at'])->diffForHumans()],
            ['Total Records', array_sum($metadata['record_counts'])],
        ]);
        
        $this->line('');
    }

    private function getAvailableBackups()
    {
        $backupDir = storage_path('app/translation-backups');
        
        if (!File::exists($backupDir)) {
            return collect();
        }

        return collect(File::directories($backupDir))->map(function ($path) {
            return ['name' => basename($path)];
        })->sortByDesc('name')->values();
    }

    private function listBackups(): void
    {
        $this->call('translations:backup', ['--list' => true]);
    }

    private function orderTablesByDependency(array $tables): array
    {
        // Define the proper restoration order based on foreign key dependencies
        $order = [
            'languages',                // No dependencies
            'translation_categories',   // No dependencies  
            'translation_keys',         // Depends on translation_categories
            'translation_values',       // Depends on translation_keys and languages
        ];

        // Filter and return only the tables that were selected for restoration
        return array_filter($order, function($table) use ($tables) {
            return in_array($table, $tables);
        });
    }

    private function convertDatetimeFields(array $record, $model): array
    {
        // Get datetime fields from the model's casts or known datetime fields
        $datetimeFields = ['translated_at', 'reviewed_at', 'approved_at', 'last_translated_at', 'last_updated_at'];
        
        foreach ($datetimeFields as $field) {
            if (isset($record[$field]) && $record[$field] !== null) {
                try {
                    // Convert ISO format to MySQL datetime format
                    $record[$field] = Carbon::parse($record[$field])->format('Y-m-d H:i:s');
                } catch (\Exception $e) {
                    // If parsing fails, set to null or current time
                    $record[$field] = null;
                }
            }
        }

        return $record;
    }
}
