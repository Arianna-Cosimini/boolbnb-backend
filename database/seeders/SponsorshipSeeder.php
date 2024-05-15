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
                "title"=> "Basic",
                "price"=> "2.99",
                "description" => "Sponsorizza il tuo appartamento, risulterà primo nei suggerimenti e nelle ricerche per 24h"
            ],
            [
                "title"=> "Pro",
                "price"=> "5.99",
                "description" => "Sponsorizza il tuo appartamento, risulterà primo nei suggerimenti e nelle ricerche per 72h"
            ],
            [
                "title"=> "Ultra",
                "price"=> "9.99",
                "description" => "Sponsorizza il tuo appartamento, risulterà primo nei suggerimenti e nelle ricerche per 144h"
            ],
        ];

        foreach($sponsorships as $sponsorship) {
            $newSponsorship = new Sponsorship();
            $newSponsorship->title = $sponsorship['title'];
            $newSponsorship->price = $sponsorship['price'];
            $newSponsorship->description = $sponsorship['description'];
            $newSponsorship->save();
        }
    }
}
