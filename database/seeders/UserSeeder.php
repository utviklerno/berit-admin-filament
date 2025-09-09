<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {


// sjekke factory arrow function for å lage ekstra innhold.
        User::factory()->create([
            'id' => '99999999',
            'name' => 'Tom-Erik',
            'lastname' => 'Paulsen',
            'password' => bcrypt('te97pa'),
            'email' => 'tepaulsen@gmail.com',
            'email_verified_at' => now(),
            'phone' => '93217356',

            'is_admin' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);



        // Assuming your test database connection is configured in database.php as 'test_db'
        $testProfiles = DB::connection('test_db')
            ->table('users')
            ->get();

        foreach ($testProfiles as $profile) {
            DB::table('users')->insert([
                'id' => $profile->id,
                'email_verified_at' => now(),
                'name' => $profile->name,
                'lastname' => $profile->lastname,
                'password' => Hash::make('yksikaksi'),
                /* concat name and lastname and add @berit.app for email. Only accept az-AZ remove all other chars */
                'email' => strtolower(
                    preg_replace(
                        '/[^a-zA-Z]/',
                        '',
                        $profile->name . $profile->lastname
                    ) . '@berit.app'
                ),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
