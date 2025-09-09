<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Assuming your test database connection is configured in database.php as 'test_db'
        $userItems = DB::connection('test_db')
            ->table('user_items')
            ->get();


        foreach ($userItems as $profile) {
            DB::table('user_items')->insert([
                'id' => $profile->id,
                'id_user' => $profile->id_user,
                'id_product_type' => $profile->id_product_type,
                'id_product_type_item' => $profile->id_product_type_item,
                'id_user_location' => $profile->id_user_location,
                'pri' => $profile->pri,
                'name' => $profile->name,
                'description' => $profile->description,
                'active' => $profile->active,
                'price' => $profile->price,
                'price_interval_type' => $profile->price_interval_type,
                'price_interval_count' => $profile->price_interval_count,
                'created_at' => now(),
            ]);
        }
    }
}
