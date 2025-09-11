<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Language;
use App\Models\TranslationCategory;
use App\Models\TranslationKey;
use App\Models\TranslationValue;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class BackupTranslations extends Command
{
    protected $signature = 'translations:backup 
                          {name? : Custom backup name}
                          {--list : List existing backups}
                          {--delete= : Delete a specific backup}';

    protected $description = 'Backup translation tables to JSON files';

    public function handle()
    {
        if ($this->option('list')) {
            return $this->listBackups();
        }

        if ($this->option('delete')) {
            return $this->deleteBackup($this->option('delete'));
        }

        $this->info('🔄 Starting translations backup...');

        // Create backup directory if it doesn't exist
        $backupDir = storage_path('app/translation-backups');
        if (!File::exists($backupDir)) {
            File::makeDirectory($backupDir, 0755, true);
        }

        // Generate backup name
        $customName = $this->argument('name');
        $timestamp = Carbon::now()->format('Y-m-d_H-i-s');
        $backupName = $customName ? "{$customName}_{$timestamp}" : "backup_{$timestamp}";
        $backupPath = "{$backupDir}/{$backupName}";

        // Create backup folder
        File::makeDirectory($backupPath, 0755, true);

        // Backup each table
        $this->backupTable('languages', Language::all(), $backupPath);
        $this->backupTable('translation_categories', TranslationCategory::all(), $backupPath);
        $this->backupTable('translation_keys', TranslationKey::with('category')->get(), $backupPath);
        $this->backupTable('translation_values', TranslationValue::with(['translationKey', 'language'])->get(), $backupPath);

        // Create metadata file
        $metadata = [
            'backup_name' => $backupName,
            'created_at' => Carbon::now()->toISOString(),
            'created_by' => get_current_user(),
            'record_counts' => [
                'languages' => Language::count(),
                'translation_categories' => TranslationCategory::count(),
                'translation_keys' => TranslationKey::count(),
                'translation_values' => TranslationValue::count(),
            ],
            'laravel_version' => app()->version(),
            'php_version' => PHP_VERSION,
        ];

        File::put("{$backupPath}/metadata.json", json_encode($metadata, JSON_PRETTY_PRINT));

        $this->info("✅ Backup completed: {$backupName}");
        $this->table(['Table', 'Records'], [
            ['Languages', $metadata['record_counts']['languages']],
            ['Categories', $metadata['record_counts']['translation_categories']],
            ['Keys', $metadata['record_counts']['translation_keys']],
            ['Values', $metadata['record_counts']['translation_values']],
        ]);

        $this->line("📁 Backup location: {$backupPath}");
    }

    private function backupTable(string $tableName, $data, string $backupPath): void
    {
        $this->line("  📋 Backing up {$tableName}... ({$data->count()} records)");
        
        $jsonData = $data->map(function ($record) {
            return $record->toArray();
        })->toArray();

        File::put("{$backupPath}/{$tableName}.json", json_encode($jsonData, JSON_PRETTY_PRINT));
    }

    private function listBackups(): void
    {
        $backupDir = storage_path('app/translation-backups');
        
        if (!File::exists($backupDir)) {
            $this->warn('No backups found. Run translations:backup to create one.');
            return;
        }

        $backups = collect(File::directories($backupDir))->map(function ($path) {
            $name = basename($path);
            $metadataPath = "{$path}/metadata.json";
            
            if (File::exists($metadataPath)) {
                $metadata = json_decode(File::get($metadataPath), true);
                return [
                    'name' => $name,
                    'created' => Carbon::parse($metadata['created_at'])->diffForHumans(),
                    'size' => $this->formatBytes($this->getDirSize($path)),
                    'records' => array_sum($metadata['record_counts']),
                ];
            }

            return [
                'name' => $name,
                'created' => Carbon::createFromTimestamp(File::lastModified($path))->diffForHumans(),
                'size' => $this->formatBytes($this->getDirSize($path)),
                'records' => '?',
            ];
        })->sortByDesc('name')->values();

        if ($backups->isEmpty()) {
            $this->warn('No backups found.');
            return;
        }

        $this->info('📦 Available Translation Backups:');
        $this->table(['Name', 'Created', 'Size', 'Records'], $backups->toArray());
        $this->line('');
        $this->line('Use: translations:restore <backup-name> to restore');
        $this->line('Use: translations:backup --delete=<backup-name> to delete');
    }

    private function deleteBackup(string $backupName): void
    {
        $backupPath = storage_path("app/translation-backups/{$backupName}");
        
        if (!File::exists($backupPath)) {
            $this->error("❌ Backup '{$backupName}' not found.");
            return;
        }

        if ($this->confirm("Are you sure you want to delete backup '{$backupName}'?")) {
            File::deleteDirectory($backupPath);
            $this->info("✅ Backup '{$backupName}' deleted successfully.");
        } else {
            $this->info('Deletion cancelled.');
        }
    }

    private function getDirSize(string $path): int
    {
        $size = 0;
        foreach (File::allFiles($path) as $file) {
            $size += File::size($file);
        }
        return $size;
    }

    private function formatBytes(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $factor = floor(log($bytes, 1024));
        return sprintf('%.1f %s', $bytes / (1024 ** $factor), $units[$factor]);
    }
}
