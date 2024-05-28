<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Apartment;
use App\Models\Category;

class ApartmentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch all apartments and categories
        $apartments = Apartment::all();
        $categories = Category::all();

        // Array to hold the apartment_category relationships
        $apartmentCategories = [];

        // Loop through each apartment
        foreach ($apartments as $apartment) {
            // Select a random category for this apartment
            $category = $categories->random();

            // Add the relationship to the array
            $apartmentCategories[] = [
                'apartment_id' => $apartment->id,
                'category_id' => $category->id,
            ];
        }

        // Insert the generated relationships into the pivot table
        DB::table('apartment_category')->insert($apartmentCategories);
    }
}
