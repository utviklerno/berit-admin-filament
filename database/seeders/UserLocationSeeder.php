<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserLocationSeeder extends Seeder
{
    public function run()
    {

        // Assuming your test database connection is configured in database.php as 'test_db'
        $userLocations = DB::connection('test_db')
            ->table('user_locations')
            ->get();

        foreach ($userLocations as $location) {
            DB::table('user_locations')->insert([
                'id' => $location->id,
                'user_id' => $location->user_id,
                'primary_location' => $location->primary_location,
                'name' => $location->name,
                'street_address' => $location->street_address,
                'unit_number' => $location->unit_number,
                'city' => $location->city,
                'state' => $location->state,
                'postal_code' => $location->postal_code,
                'country' => $location->country,
                'phone' => $location->phone,
                'is_primary' => $location->is_primary,
                'delivery_instructions' => $location->delivery_instructions,
                'latitude' => $location->latitude,
                'longitude' => $location->longitude,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


    }
}
