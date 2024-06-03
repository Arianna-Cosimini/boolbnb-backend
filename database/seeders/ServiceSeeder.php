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
                "title" => "Wi-fi",
                "icon" => "/services/wifi.svg",
            ],
            [
                "title" => "Aria condizionata",
                "icon" => "/services/air-conditioning.svg",
            ],
            [
                "title" => "Barbeque",
                "icon" => "/services/bbq.svg",
            ],
            [
                "title" => "Spiaggia",
                "icon" => "/services/beach-area.svg",
            ],
            [
                "title" => "Estintore",
                "icon" => "/services/fire-ext.svg",
            ],
            [
                "title" => "Camino",
                "icon" => "/services/fireplace.svg",
            ],
            [
                "title" => "Kit di pronto soccorso",
                "icon" => "/services/first-aid-kit.svg",
            ],
            [
                "title" => "Palestra",
                "icon" => "/services/gym.svg",
            ],
            [
                "title" => "Cucina",
                "icon" => "/services/kitchen.svg",
            ],
            [
                "title" => "Idromassaggio",
                "icon" => "/services/hot-tub.svg",
            ],
            [
                "title" => "Lago",
                "icon" => "/services/lake-area.svg",
            ],
            [
                "title" => "Cena all'aperto",
                "icon" => "/services/outdoor-dining.svg",
            ],
            [
                "title" => "Parcheggio",
                "icon" => "/services/parking.svg",
            ],
            [
                "title" => "Parcheggio a pagamento",
                "icon" => "/services/paid-parking.svg",
            ],
            [
                "title" => "Patio o balcone",
                "icon" => "/services/patio.svg",
            ],
            [
                "title" => "Pianoforte",
                "icon" => "/services/piano.svg",
            ],
            [
                "title" => "Tavolo da biliardo",
                "icon" => "/services/pool-table.svg",
            ],
            [
                "title" => "Piscina",
                "icon" => "/services/pool.svg",
            ],
            [
                "title" => "Doccia",
                "icon" => "/services/shower.svg",
            ],
            [
                "title" => "Sci",
                "icon" => "/services/ski.svg",
            ],
            [
                "title" => "Allarme antifumo",
                "icon" => "/services/smoke-alarm.svg",
            ],
            [
                "title" => "TV",
                "icon" => "/services/tv.svg",
            ],
            [
                "title" => "Lavatrice",
                "icon" => "/services/washing-machine.svg",
            ],
            [
                "title" => "Spazio di lavoro dedicato",
                "icon" => "/services/workspace.svg",
            ],


        ];

        foreach ($services as $service) {
            $newService = new Service();
            $newService->title = $service['title'];
            $newService->icon = $service['icon'];
            $newService->save();
        }
    }
}
