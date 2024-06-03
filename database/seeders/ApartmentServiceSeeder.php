<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Apartment;
use App\Models\Service;

class ApartmentServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch all apartments and services
        $apartments = Apartment::all();
        $services = Service::all();

        // Array to hold the apartment_service relationships
        $apartmentServices = [];

        // Loop through each apartment
        foreach ($apartments as $apartment) {
            // Determine the number of services to assign to this apartment (between 1 and 3)
            $numberOfServicesForApartment = rand(5, 15);

            // Select random unique services for this apartment
            $servicesForApartment = $services->random($numberOfServicesForApartment);

            // Add each service for this apartment to the array
            foreach ($servicesForApartment as $service) {
                $apartmentServices[] = [
                    'apartment_id' => $apartment->id,
                    'service_id' => $service->id,
                ];
            }
        }

        // Insert the generated relationships into the pivot table
        DB::table('apartment_service')->insert($apartmentServices);
    }
}
