<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            
            ApartmentSeeder::class,

            MessageSeeder::class,

            //View Seeder
            ViewSeeder::class,
             

            ServiceSeeder::class,

            CategorySeeder::class,

            SponsorshipSeeder::class,

            ApartmentSponsorshipSeeder::class,

            UserSeeder::class,

            ApartmentServiceSeeder::class,

            ApartmentCategorySeeder::class,
        ]);
         
       

    }
}
