<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    //
    public function index(Request $request) {

        // values of request
        $filters = $request->all();

        //default command to set 20 km
        /* $radius = $filters['radius'] ?? 20000; */

        $query = Apartment::with(['user', 'message', 'view', 'services', 'categories', 'sponsorships']);

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

        $apartments = $query->get(); 

        return response()->json([
            "success" => true,
            "results" => $apartments,
        ]);


       
    }
}
