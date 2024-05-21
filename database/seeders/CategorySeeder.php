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
                "title" => "Casa",
                "icon" => "/icons/house.svg",
            ],
            [
                "title" => "Appartamento",
                "icon" => "/icons/apartment.svg",
            ],
            [
                "title" => "Fienile",
                "icon" => "/icons/barn.svg",
            ],
            [
                "title" => "B&B",
                "icon" => "/icons/bandb.svg",
            ],
            [
                "title" => "Baita",
                "icon" => "/icons/cabin.svg",
            ],
            [
                "title" => "Camper",
                "icon" => "/icons/campervan.svg",
            ],
            [
                "title" => "Casa particular",
                "icon" => "/icons/casa-particular.svg",
            ],
            [
                "title" => "Castello",
                "icon" => "/icons/castle.svg",
            ],
            [
                "title" => "Grotta",
                "icon" => "/icons/cave.svg",
            ],
            [
                "title" => "Container",
                "icon" => "/icons/container.svg",
            ],
            [
                "title" => "Casa cicladica",
                "icon" => "/icons/cycladic-home.svg",
            ],
            [
                "title" => "Dammuso",
                "icon" => "/icons/dammuso.svg",
            ],
            [
                "title" => "Cupola",
                "icon" => "/icons/dome.svg",
            ],
            [
                "title" => "Trullo",
                "icon" => "/icons/trullo.svg",
            ],
            [
                "title" => "Fattoria",
                "icon" => "/icons/farm.svg",
            ],
            [
                "title" => "Pensione",
                "icon" => "/icons/guesthouse.svg",
            ],
            [
                "title" => "Hotel",
                "icon" => "/icons/hotel.svg",
            ],
            [
                "title" => "Casa galleggiante",
                "icon" => "/icons/houseboat.svg",
            ],
            [
                "title" => "Kezhan",
                "icon" => "/icons/kezhan.svg",
            ],
            [
                "title" => "Minsu",
                "icon" => "/icons/minsu.svg",
            ],
            [
                "title" => "Raid",
                "icon" => "/icons/raid.svg",
            ],
            [
                "title" => "Ryokan",
                "icon" => "/icons/ryokan.svg",
            ],
            [
                "title" => "Tenda",
                "icon" => "/icons/tent.svg",
            ],
            [
                "title" => "Torre",
                "icon" => "/icons/tower.svg",
            ],


        ];

        foreach ($categories as $category) {
            $newCategory = new Category();
            $newCategory->title = $category['title'];
            $newCategory->icon = $category['icon'];
            $newCategory->save();
        }
    }
}
