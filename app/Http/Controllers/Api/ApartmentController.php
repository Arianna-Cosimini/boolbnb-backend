<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index(){
        // ci restituisc tutti gli appartamenti dal db
        $apartments=Apartment::all();
        // dd($apartments);

        return response()->json([
            "success"=>true,
            "results"=>$apartments
        ]);
    }
}
