<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            "Casa indipendente",
            "Appartamento",
            "Pensione",
            "Hotel",
        ];

        foreach($categories as $category) {
            $newCategory = new Category();
            $newCategory->title = $category;
            $newCategory->save();
        }
    }
}
