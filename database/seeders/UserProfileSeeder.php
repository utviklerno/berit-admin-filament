<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserProfileSeeder extends Seeder
{
    public function run()
    {
        // Assuming your test database connection is configured in database.php as 'test_db'
        $testProfiles = DB::connection('test_db')
            ->table('user_profiles')
            ->get();


        foreach ($testProfiles as $profile) {
            DB::table('user_profiles')->insert([
                'user_id' => $profile->user_id,
                'street_address' => $profile->street_address,
                'city' => $profile->city,
                'state' => $profile->state,
                'postal_code' => $profile->postal_code,
                'country' => $profile->country,
                'phone_number' => $profile->phone_number,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
