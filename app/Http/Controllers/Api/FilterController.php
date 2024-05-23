<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Service;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    //
    public function index(Request $request) {

        // values of request
        $filters = $request->all();

        // Coordinate di default
        $lat = 44.4949;
        $lon = 11.3426;
        $range = 20; // 20 km

        // Ottenere la posizione dell'utente o l'indirizzo desiderato
        $lat = $request->input('lat', $lat);
        $lon = $request->input('lon', $lon);
        $range = $request->input('range', $range);

        //default command to set 20 km
        /* $radius = $filters['radius'] ?? 20000; */

        $query = Apartment::select('apartments.*')
        ->selectRaw("(6371 * acos(cos(radians($lat)) * cos(radians(latitude)) * cos(radians(longitude) - radians($lon)) + sin(radians($lat)) * sin(radians(latitude)))) AS distance")
        ->having('distance', '<=', $range)
        ->orderBy('distance', 'asc')
        ->with(['user', 'message', 'view', 'services', 'categories', 'sponsorships']);

        if(isset($filters['room_number'])){
            $query->where('room_number' , '>=' ,$filters['room_number']) ;
        }

        if(isset($filters['bed_number'])) {
            $query->where('bed_number' , '>=' ,$filters['bed_number']) ;
        }

        // Filtra per servizi se richiesto
        if ($request->has('services')) {
            $services = $request->input('services');
            $servicesArr = explode(',', $services); 
    
            foreach ($servicesArr as $serviceId) {
                $query->whereHas('services', function ($query) use ($serviceId) {
                    $query->where('service_id', $serviceId); 
                });
            }
        }

        $apartments = $query->paginate(12); 
        $allServices = Service::all();

        return response()->json([
            "success" => true,
            "results" => $apartments,
            "services" => $allServices
        ]);


       
    }
}
