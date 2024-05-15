<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $numberOfApartments = 10;
        $location = "Bologna";

        $response = Http::withOptions(['verify' => false])->get('https://api.tomtom.com/search/2/geocode/' . urlencode($location) . '.json', [
            'key' => 'RrNofIXHXhCLSto2sM1SEfvmA1AamCSs',
        ]);

        $latitude = $response['results'][0]['position']['lat'];
        $longitude = $response['results'][0]['position']['lon'];

        for ($i = 0; $i < $numberOfApartments; $i++) {

            $apartmentLatitude = $latitude + mt_rand(-100, 100) * 0.00001;
            $apartmentLongitude = $longitude + mt_rand(-100, 100) * 0.00001;

            $apartment = new Apartment();
            $apartment->user_id = rand(1, 4);
            $apartment->name = "Appartamento " . ($i + 1);
            // $apartment->image = "https://a0.muscache.com/im/pictures/miso/Hosting-881808599061267756/original/b16970cf-1d55-4edd-bb1f-e1735d0a228e.jpeg?im_w=2560&im_q=highq";
            $apartment->room_number = rand(1, 5);
            $apartment->bed_number = rand(1, 10);
            $apartment->bathroom_number = rand(1, 3);
            $apartment->square_meters = rand(50, 200);
            $apartment->address = "Indirizzo " . ($i + 1) . ", " . $location;
            $apartment->latitude = $apartmentLatitude;
            $apartment->longitude = $apartmentLongitude;
            $apartment->visible = true;
            $apartment->save();
        }

    }
}
