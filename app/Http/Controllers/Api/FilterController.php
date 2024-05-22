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

        if(isset($filters['rooms'])){
            $query->where('rooms' , '>=' ,$filters['rooms']) ;
        }

        if(isset($filters['bed_number'])) {
            $query->where('bed_number' , '>=' ,$filters['bed_number']) ;
        }

        $apartments = $query->get();

        return response()->json([
            "success" => true,
            "results" => $apartments,
        ]);


       
    }
}
