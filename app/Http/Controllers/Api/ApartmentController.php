<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index()
    {
        // ci restituisc tutti gli appartamenti dal db
        // $apartments=Apartment::all();
        // dd($apartments);

        // $apartments=Apartment::paginate(5);
        $apartments = Apartment::with(['user', 'message', 'view', 'services', 'categories', 'sponsorships'])->paginate(12);

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
