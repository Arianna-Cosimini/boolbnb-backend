<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartmentSponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apartmentSponsorships = [
            [
                "apartment_id" => "2",
                "sponsor_id" => "3",
                "start_date" => "",
                "end_date" => ""
            ],
            [
                "apartment_id" => "7",
                "sponsor_id" => "3",
                "start_date" => "",
                "end_date" => ""
            ],
            [
                "apartment_id" => "9",
                "sponsor_id" => "3",
                "start_date" => "",
                "end_date" => ""
            ],
        ];
        
        foreach ($apartmentSponsorships as $apartmentSponsorship) {

            $currentDate = date("Y-m-d H:i:s");

            $apartmentSponsorship["start_date"] = $currentDate;

            if ($apartmentSponsorship['sponsor_id'] == 1) {
                $sponsorDate = date("Y-m-d H:i:s", strtotime('+24 hours', strtotime($currentDate)));
            } else if ($apartmentSponsorship['sponsor_id'] == 2) {
                $sponsorDate = date("Y-m-d H:i:s", strtotime('+72 hours', strtotime($currentDate)));
            } else if ($apartmentSponsorship['sponsor_id'] == 3) {
                $sponsorDate = date("Y-m-d H:i:s", strtotime('+144 hours', strtotime($currentDate)));
            }

            $apartmentSponsorship["end_date"] = $sponsorDate;
        }
    }
}
