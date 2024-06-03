<?php

namespace Database\Seeders;

use App\Models\Sponsorship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sponsorships = [
            [
                "title" => "Basic",
                "price" => "2.99",
                "description" => "Metti in evidenza la tua struttura per 24 ore, posizionandola in cima ai suggerimenti e ai risultati di ricerca."
            ],
            [
                "title" => "Pro",
                "price" => "5.99",
                "description" => "Dai maggiore visibilità alla tua struttura per 72 ore, garantendo il primo posto nei suggerimenti e nei risultati di ricerca."
            ],
            [
                "title" => "Ultra",
                "price" => "9.99",
                "description" => "Assicura la massima esposizione per la tua struttura per 144 ore, mantenendola in cima ai suggerimenti e ai risultati di ricerca."
            ],
        ];

        foreach ($sponsorships as $sponsorship) {
            $newSponsorship = new Sponsorship();
            $newSponsorship->title = $sponsorship['title'];
            $newSponsorship->price = $sponsorship['price'];
            $newSponsorship->description = $sponsorship['description'];
            $newSponsorship->save();
        }
    }
}
