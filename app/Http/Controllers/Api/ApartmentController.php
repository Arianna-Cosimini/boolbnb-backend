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
        // ci restituisc tutti gli appartamenti dal db
        // $apartments=Apartment::all();
        // dd($apartments);

        // $apartments=Apartment::paginate(5);
        $apartments = Apartment::with(['user', 'message', 'view', 'services', 'categories', 'sponsorships']);

        if ($request->has('services')) {
            $services= $request->input('services');
            $servicesArr= explode(', ', $services);

            $apartments->whereHas('services', function ($apartments) use ($servicesArr) {
                $apartments->whereIn('service_id', $servicesArr);
            });
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
