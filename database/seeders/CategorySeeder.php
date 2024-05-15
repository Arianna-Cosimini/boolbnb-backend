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
            [
                "title"=> "Casa indipendente",
                "icon"=> "fa-solid fa-house",
            ],
            [
                "title"=> "Appartamento",
                "icon"=> "fa-solid fa-building",
            ],
            [
                "title"=> "Hotel",
                "icon"=> "fa-solid fa-hotel",
            ],
 
        ];

        foreach($categories as $category) {
            $newCategory = new Category();
            $newCategory->title = $category['title'];
            $newCategory->icon = $category['icon'];
            $newCategory->save();
        }
    }
}
