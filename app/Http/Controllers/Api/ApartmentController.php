<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index(Request $request)
    {
        // Coordinate di riferimento e raggio in metri
        $latitude = 44.4949;
        $longitude = 11.3426;
        $distanceLimit = 20000; // 20 km

        // Query per calcolare la distanza e filtrare gli appartamenti
        $address = $request->input('address'); // Get address from request

        $apartments = Apartment::where('address', 'like', "%{$address}%") // Street-level filtering
            ->selectRaw("
                apartments.*,
                ST_Distance_Sphere(
                    Point(?, ?),
                    Point(apartments.longitude, apartments.latitude)
                ) AS distance
            ", [$longitude, $latitude])
            ->with(['user', 'message', 'view', 'services', 'categories', 'sponsorships'])
            ->havingRaw("distance < ?", [$distanceLimit])
            ->orderBy('distance');
        // ci restituisc tutti gli appartamenti dal db
        // $apartments = Apartment::with('services');
        // dd($apartments);


        if ($request->has('services')) {
            $services= $request->input('services');
            $servicesArr= explode(',', $services);

            $apartments->whereHas('services', function ($apartments) use ($servicesArr) {
                $apartments->whereIn('service_id', $servicesArr);
            })->orWhereHas('services', function ($apartments) use ($servicesArr) {
                $apartments->whereIn('service_id', $servicesArr);
            }, '=', count($servicesArr));

        }

        $allApartments= $apartments->paginate(12);
        $allServices = Service::all();

        return response()->json([
            "success" => true,
            "results" => $allApartments,
            "services" => $allServices
        ]);
    }


    public function show($slug)
    {
        // $Apartment = Apartment::find($id);

        $apartment = Apartment::with(['user', 'message', 'view', 'services', 'categories', 'sponsorships'])->where('slug', '=', $slug)->first();


        if ($apartment) {
            return response()->json([
                "success" => true,
                "apartment" => $apartment
            ]);
        } else {
            return response()->json([
                "success" => false,
                "error" => "Progetto non trovato"
            ]);
        }
    }
}
