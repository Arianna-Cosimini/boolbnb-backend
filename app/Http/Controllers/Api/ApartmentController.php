<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index(Request $request)
    {

        // Query per filtrare gli appartamenti in base alla distanza e al raggio
        $apartments = Apartment::with(['user', 'message', 'view', 'services', 'categories', 'sponsorships'])->get();
            // dd($apartments->get()->pluck('distance')->toArray());


        // // Esegui la paginazione e ottieni i risultati
        // $allApartments = $apartments->paginate(12);


        return response()->json([
            "success" => true,
            "results" => $apartments
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
