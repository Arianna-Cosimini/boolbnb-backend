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
        // Coordinate di default
        $lat = 44.4949;
        $lon = 11.3426;
        $range = 20; // 20 km

        // Ottenere la posizione dell'utente o l'indirizzo desiderato
        $lat = $request->input('lat', $lat);
        $lon = $request->input('lon', $lon);

        // Query per filtrare gli appartamenti in base alla distanza e al raggio
        $apartments = Apartment::select('apartments.*')
            ->selectRaw("(6371 * acos(cos(radians($lat)) * cos(radians(latitude)) * cos(radians(longitude) - radians($lon)) + sin(radians($lat)) * sin(radians(latitude)))) AS distance")
            ->having('distance', '<=', $range)
            ->orderBy('distance', 'asc')
            ->with(['user', 'message', 'view', 'services', 'categories', 'sponsorships']);
            // dd($apartments->get()->pluck('distance')->toArray());
        // Filtra per servizi se richiesto
        if ($request->has('services')) {
            $services= $request->input('services');
            $servicesArr= explode(',', $services);

            $apartments->whereHas('services', function ($apartments) use ($servicesArr) {
                $apartments->whereIn('service_id', $servicesArr);
            })->orWhereHas('services', function ($apartments) use ($servicesArr) {
                $apartments->whereIn('service_id', $servicesArr);
            }, '=', count($servicesArr));

        }

        // Esegui la paginazione e ottieni i risultati
        $allApartments = $apartments->paginate(12);
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
