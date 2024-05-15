<?php

namespace Database\Seeders;

use App\Models\ApartmentSponsorship;
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
                "sponsorship_id" => "3",
                "start_date" => "",
                "end_date" => ""
            ],
            [
                "apartment_id" => "7",
                "sponsorship_id" => "2",
                "start_date" => "",
                "end_date" => ""
            ],
            [
                "apartment_id" => "9",
                "sponsorship_id" => "1",
                "start_date" => "",
                "end_date" => ""
            ],
        ];
        
        foreach ($apartmentSponsorships as $apartmentSponsorship) {

            $newapartmentsponsorship = new ApartmentSponsorship();

            $newapartmentsponsorship->apartment_id = $apartmentSponsorship['apartment_id'];
            $newapartmentsponsorship->sponsorship_id = $apartmentSponsorship['sponsorship_id'];

            $currentDate = date("Y-m-d H:i:s");

            $apartmentSponsorship["start_date"] = $currentDate;
            $newapartmentsponsorship->start_date = $apartmentSponsorship['start_date'];

            if ($apartmentSponsorship['sponsorship_id'] == 1) {
                $sponsorDate = date("Y-m-d H:i:s", strtotime('+24 hours', strtotime($currentDate)));
            } else if ($apartmentSponsorship['sponsorship_id'] == 2) {
                $sponsorDate = date("Y-m-d H:i:s", strtotime('+72 hours', strtotime($currentDate)));
            } else if ($apartmentSponsorship['sponsorship_id'] == 3) {
                $sponsorDate = date("Y-m-d H:i:s", strtotime('+144 hours', strtotime($currentDate)));
            }

            $apartmentSponsorship["end_date"] = $sponsorDate;
            $newapartmentsponsorship->end_date = $apartmentSponsorship['end_date'];

            $newapartmentsponsorship->save();
        }
    }
}
