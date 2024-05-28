<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index(Request $request)
    {
        // Coordinate di default
        $lat = 44.4949;
        $lon = 11.3426;
        $range = 20; // 20 km

        $query = Apartment::select('apartments.*')
            ->selectRaw("(6371 * acos(cos(radians($lat)) * cos(radians(latitude)) * cos(radians(longitude) - radians($lon)) + sin(radians($lat)) * sin(radians(latitude)))) AS distance")
            ->join('apartment_sponsorship', function($join) {
                $join->on('apartments.id', '=', 'apartment_sponsorship.apartment_id')
                     ->where('apartment_sponsorship.end_date', '>', Carbon::now());
            })
            ->having('distance', '<=', $range)
            ->orderBy('distance')
            ->with(['user', 'message', 'view', 'services', 'categories', 'sponsorships']);

        $query->where('visible', 1);

        $apartments = $query->paginate(12); 

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
