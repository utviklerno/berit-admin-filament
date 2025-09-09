<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "Creating admin users...\n";

        // Create main admin user
        AdminUser::updateOrCreate(
            ['email' => 'tepaulsen@gmail.com'],
            [
                'name' => 'Tom-Erik Paulsen',
                'email' => 'tepaulsen@gmail.com',
                'password' => Hash::make('te97pa'),
                'email_verified_at' => now(),
            ]
        );

        // Create default admin user
        AdminUser::updateOrCreate(
            ['email' => 'admin@berit.app'],
            [
                'name' => 'Admin User',
                'email' => 'admin@berit.app',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Create development admin user
        AdminUser::updateOrCreate(
            ['email' => 'dev@berit.app'],
            [
                'name' => 'Developer',
                'email' => 'dev@berit.app',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Create additional admin users if needed
        if (app()->environment('local', 'development')) {
            echo "Creating additional development admin users...\n";
            
            AdminUser::factory()->createMany([
                [
                    'name' => 'John Doe',
                    'email' => 'john@berit.app',
                    'password' => Hash::make('password'),
                ],
                [
                    'name' => 'Jane Smith',
                    'email' => 'jane@berit.app', 
                    'password' => Hash::make('password'),
                ],
            ]);
        }

        echo "AdminUserSeeder completed successfully!\n";
    }
}
