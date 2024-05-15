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
            "Self check-in",
            "Wi-Fi",
            "TV",
            "Netflix o altri servizi di streaming",
            "Cucina completamente attrezzata",
            "Parcheggio gratuito in struttura",
            "Piscina condivisa",
            "Ascensore",
            "Aria condizionata",
            "Vasca da bagno",
            "Asciugacapelli",
            "Vista mare"
        ];

        foreach($services as $service) {
            $newService = new Service();
            $newService->title = $service;
            $newService->save();
        }
    }
}
