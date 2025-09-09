<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserLocation;
use App\Models\UserItem;
use App\Models\ProductType;
use App\Models\ProductTypeItem;
use Illuminate\Support\Facades\DB;

class UserItemSeeder extends Seeder
{
    public function run()
    {
        echo "Creating ProductTypes and ProductTypeItems...\n";
        
        // Create basic ProductTypes
        $productTypes = [
            ['id' => 1, 'name' => 'Parkering', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Opplag', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Selvbetjent lagring', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Lagerplasser', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'name' => 'Kommersielt lager', 'created_at' => now(), 'updated_at' => now()],
        ];
        
        DB::table('product_types')->upsert($productTypes, ['id'], ['name', 'updated_at']);

        // Create ProductTypeItems
        $productTypeItems = [
            // Parkering
            ['id' => 1, 'id_product_type' => 1, 'name' => 'Parkeringsplasser', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'id_product_type' => 1, 'name' => 'Langtidsparkering', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'id_product_type' => 1, 'name' => 'Lagring bil', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'id_product_type' => 1, 'name' => 'Lagring bobil', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'id_product_type' => 1, 'name' => 'Lagring motorsykkel', 'created_at' => now(), 'updated_at' => now()],
            
            // Opplag
            ['id' => 6, 'id_product_type' => 2, 'name' => 'Båtopplag inne', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'id_product_type' => 2, 'name' => 'Båtopplag ute', 'created_at' => now(), 'updated_at' => now()],
            
            // Selvbetjent lagring
            ['id' => 8, 'id_product_type' => 3, 'name' => 'Selvbetjente lagerenheter', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9, 'id_product_type' => 3, 'name' => 'Lagercontainere', 'created_at' => now(), 'updated_at' => now()],
            
            // Lagerplasser
            ['id' => 10, 'id_product_type' => 4, 'name' => 'Garasjer og boder', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 11, 'id_product_type' => 4, 'name' => 'Uthus og skur', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 12, 'id_product_type' => 4, 'name' => 'Ekstra rom', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 13, 'id_product_type' => 4, 'name' => 'Kjeller', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 14, 'id_product_type' => 4, 'name' => 'Loft', 'created_at' => now(), 'updated_at' => now()],
            
            // Kommersielt lager
            ['id' => 15, 'id_product_type' => 5, 'name' => 'Varehus / Lagerbygninger', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 16, 'id_product_type' => 5, 'name' => 'Bedriftslagring', 'created_at' => now(), 'updated_at' => now()],
        ];
        
        DB::table('product_type_items')->upsert($productTypeItems, ['id'], ['name', 'updated_at']);

        echo "Creating UserItems for each user...\n";
        
        // Get all users with their locations
        $usersWithLocations = User::with('locations')->get();
        
        $userItemsData = [];
        $itemDescriptions = [
            'Trygt og sikkert område',
            'Lett tilgjengelig lokasjon',
            'Tørr og ren lagringsplass',
            'Overvåket område med kameraer',
            'Perfekt størrelse for dine behov',
            'Ledig straks, fleksible avtaler',
            'Godt vedlikeholdt område',
            'Sentralt beliggende',
            'Konkurransedyktige priser',
            'Utmerket for langtidslagring',
        ];
        
        $priceIntervalTypes = ['day', 'week', 'month'];
        
        $itemId = 1;
        
        foreach ($usersWithLocations as $user) {
            if ($user->locations->isEmpty()) {
                echo "User {$user->name} has no locations, skipping...\n";
                continue;
            }
            
            // Create 1-3 items per user
            $itemCount = rand(1, 3);
            
            for ($i = 0; $i < $itemCount; $i++) {
                // Get random location for this user
                $location = $user->locations->random();
                
                // Get random product type item
                $productTypeItem = $productTypeItems[array_rand($productTypeItems)];
                
                // Create item name with some variation
                $itemNames = [
                    $productTypeItem['name'],
                    $productTypeItem['name'] . ' Pro',
                    $productTypeItem['name'] . ' Deluxe',
                    'Professional ' . $productTypeItem['name'],
                    'Premium ' . $productTypeItem['name'],
                ];
                
                $userItemsData[] = [
                    'id' => $itemId++,
                    'id_user' => $user->id,
                    'id_product_type' => $productTypeItem['id_product_type'],
                    'id_product_type_item' => $productTypeItem['id'],
                    'id_user_location' => $location->id,
                    'pri' => rand(0, 10),
                    'name' => $itemNames[array_rand($itemNames)],
                    'description' => $itemDescriptions[array_rand($itemDescriptions)],
                    'active' => rand(0, 10) > 1, // 90% chance of being active
                    'price' => rand(50, 2000) * 10, // Price between 500-20000 (in øre/cents)
                    'price_interval_type' => $priceIntervalTypes[array_rand($priceIntervalTypes)],
                    'price_interval_count' => rand(1, 3),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        
        echo "Creating " . count($userItemsData) . " user items...\n";
        
        // Insert in chunks for better performance
        $chunks = array_chunk($userItemsData, 500);
        
        foreach ($chunks as $chunkIndex => $chunk) {
            DB::table('user_items')->insert($chunk);
            echo "Processed chunk " . ($chunkIndex + 1) . " of " . count($chunks) . "...\n";
        }
        
        echo "UserItemSeeder completed successfully!\n";
        echo "Created " . count($userItemsData) . " items for " . $usersWithLocations->count() . " users.\n";
    }
}