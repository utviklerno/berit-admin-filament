<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Collection;

class UserSeeder extends Seeder
{
    public function run()
    {
        echo "Creating admin user...\n";
        
        User::updateOrCreate(
            ['email' => 'tepaulsen@gmail.com'],
            [
                'id' => '99999999',
                'name' => 'Tom-Erik',
                'lastname' => 'Paulsen',
                'password' => bcrypt('te97pa'),
                'email_verified_at' => now(),
                'phone' => '93217356',
                'is_admin' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        echo "Fetching test profiles...\n";
        
        // Get test profiles in chunks for better memory usage
        $testProfiles = DB::connection('test_db')
            ->table('users')
            ->get();

        if ($testProfiles->isEmpty()) {
            echo "No test profiles found.\n";
            return;
        }

        echo "Processing " . $testProfiles->count() . " profiles...\n";

        // Get existing user IDs and emails for checking
        $existingUserIds = DB::table('users')->pluck('id')->toArray();
        $existingEmails = DB::table('users')->pluck('email')->toArray();
        
        $usersData = [];
        $usedEmails = $existingEmails; // Track emails we've used
        
        foreach ($testProfiles as $index => $profile) {
            // Generate base email
            $cleanName = preg_replace('/[^a-zA-Z]/', '', $profile->name . $profile->lastname);
            $baseEmail = strtolower($cleanName . '@berit.app');
            
            // Make email unique
            $email = $baseEmail;
            $counter = 1;
            
            // Keep trying until we get a unique email
            while (in_array($email, $usedEmails)) {
                $email = strtolower($cleanName . $counter . '@berit.app');
                $counter++;
            }
            
            // Mark this email as used
            $usedEmails[] = $email;
            
            $userData = [
                'id' => $profile->id,
                'email_verified_at' => now(),
                'name' => $profile->name,
                'lastname' => $profile->lastname,
                'password' => Hash::make('yksikaksi'),
                'email' => $email,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $usersData[] = $userData;
            
            // Show progress every 100 records
            if (($index + 1) % 100 == 0) {
                echo "Processed " . ($index + 1) . " of " . $testProfiles->count() . " profiles...\n";
            }
        }

        // Use upsert for better performance (insert or update)
        echo "Upserting " . count($usersData) . " users...\n";
        $chunks = array_chunk($usersData, 500);
        
        foreach ($chunks as $chunkIndex => $chunk) {
            DB::table('users')->upsert(
                $chunk,
                ['id'], // Unique identifier
                ['email_verified_at', 'name', 'lastname', 'password', 'email', 'updated_at'] // Fields to update
            );
            echo "Processed chunk " . ($chunkIndex + 1) . " of " . count($chunks) . "...\n";
        }

        echo "UserSeeder completed successfully!\n";
    }
}
