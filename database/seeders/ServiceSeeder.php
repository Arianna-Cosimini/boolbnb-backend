<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                "title"=> "Wi-Fi",
                "icon"=> "fa-solid fa-wifi",
            ],
            [
                "title"=> "TV",
                "icon"=> "fa-solid fa-tv",
            ],
            [
                "title"=> "Cucina",
                "icon"=> "fa-solid fa-kitchen-set",
            ],
            [
                "title"=> "Parcheggio",
                "icon"=> "fa-solid fa-square-parking",
            ],
            [
                "title"=> "Piscina",
                "icon"=> "fa-solid fa-water-ladder",
            ],
            [
                "title"=> "Ascensore",
                "icon"=> "fa-solid fa-elevator",
            ],
            [
                "title"=> "Aria condizionata",
                "icon"=> "fa-solid fa-temperature-arrow-down",
            ],
            [
                "title"=> "Vasca da bagno",
                "icon"=> "fa-solid fa-bath",
            ],
 
        ];

        foreach($services as $service) {
            $newService = new Service();
            $newService->title = $service['title'];
            $newService->icon = $service['icon'];
            $newService->save();
        }
    }
}
