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
            ['id' => 1, 'name' => 'Parkering', 'pri' => 1, 'description' => 'Parkerings- og kjøretøylagring'],
            ['id' => 2, 'name' => 'Opplag', 'pri' => 2, 'description' => 'Båtopplag og oppbevaring'],
            ['id' => 3, 'name' => 'Selvbetjent lagring', 'pri' => 3, 'description' => 'Selvbetjent lagring og containere'],
            ['id' => 4, 'name' => 'Lagerplasser', 'pri' => 4, 'description' => 'Private lagerplasser og rom'],
            ['id' => 5, 'name' => 'Kommersielt lager', 'pri' => 5, 'description' => 'Kommersielle lagerlokaler'],
        ];
        
        DB::table('product_types')->upsert($productTypes, ['id'], ['name', 'pri', 'description']);

        // Create ProductTypeItems
        $productTypeItems = [
            // Parkering
            ['id' => 1, 'product_type_id' => 1, 'name' => 'Parkeringsplasser', 'pri' => 1, 'description' => 'Daglige parkeringsplasser', 'price' => 10000],
            ['id' => 2, 'product_type_id' => 1, 'name' => 'Langtidsparkering', 'pri' => 2, 'description' => 'Parkering for lengre perioder', 'price' => 150000],
            ['id' => 3, 'product_type_id' => 1, 'name' => 'Lagring bil', 'pri' => 3, 'description' => 'Innendørs billagring', 'price' => 200000],
            ['id' => 4, 'product_type_id' => 1, 'name' => 'Lagring bobil', 'pri' => 4, 'description' => 'Lagring av bobil og campingvogn', 'price' => 300000],
            ['id' => 5, 'product_type_id' => 1, 'name' => 'Lagring motorsykkel', 'pri' => 5, 'description' => 'Trygg lagring av motorsykkel', 'price' => 80000],
            
            // Opplag
            ['id' => 6, 'product_type_id' => 2, 'name' => 'Båtopplag inne', 'pri' => 1, 'description' => 'Innendørs båtlagring', 'price' => 400000],
            ['id' => 7, 'product_type_id' => 2, 'name' => 'Båtopplag ute', 'pri' => 2, 'description' => 'Utendørs båtlagring', 'price' => 250000],
            
            // Selvbetjent lagring
            ['id' => 8, 'product_type_id' => 3, 'name' => 'Selvbetjente lagerenheter', 'pri' => 1, 'description' => 'Selvbetjente lagerrom', 'price' => 120000],
            ['id' => 9, 'product_type_id' => 3, 'name' => 'Lagercontainere', 'pri' => 2, 'description' => 'Containere for lagring', 'price' => 180000],
            
            // Lagerplasser
            ['id' => 10, 'product_type_id' => 4, 'name' => 'Garasjer og boder', 'pri' => 1, 'description' => 'Private garasjer og boder', 'price' => 160000],
            ['id' => 11, 'product_type_id' => 4, 'name' => 'Uthus og skur', 'pri' => 2, 'description' => 'Uthus og mindre skur', 'price' => 100000],
            ['id' => 12, 'product_type_id' => 4, 'name' => 'Ekstra rom', 'pri' => 3, 'description' => 'Ledige rom til lagring', 'price' => 80000],
            ['id' => 13, 'product_type_id' => 4, 'name' => 'Kjeller', 'pri' => 4, 'description' => 'Kjellerlokaler', 'price' => 70000],
            ['id' => 14, 'product_type_id' => 4, 'name' => 'Loft', 'pri' => 5, 'description' => 'Loftslokaler', 'price' => 60000],
            
            // Kommersielt lager
            ['id' => 15, 'product_type_id' => 5, 'name' => 'Varehus / Lagerbygninger', 'pri' => 1, 'description' => 'Store lagerlokaler', 'price' => 500000],
            ['id' => 16, 'product_type_id' => 5, 'name' => 'Bedriftslagring', 'pri' => 2, 'description' => 'Bedriftslagring og arkiv', 'price' => 350000],
        ];
        
        DB::table('product_type_items')->upsert($productTypeItems, ['id'], ['name', 'pri', 'description', 'price']);

        echo "Creating UserItems for each user...\n";
        
        // Get all users with their locations
        $usersWithLocations = User::with('locations')->get();
        $usersWithLocationsCount = $usersWithLocations->filter(function ($user) {
            return $user->locations->isNotEmpty();
        })->count();
        
        echo "Found {$usersWithLocationsCount} users with locations out of {$usersWithLocations->count()} total users...\n";
        
        if ($usersWithLocationsCount === 0) {
            echo "No users have locations! Please run UserLocationSeeder first.\n";
            return;
        }
        
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
        
        // Get the next available ID to avoid conflicts
        $maxId = DB::table('user_items')->max('id') ?? 0;
        $itemId = $maxId + 1;
        
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
                    'id_product_type' => $productTypeItem['product_type_id'],
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