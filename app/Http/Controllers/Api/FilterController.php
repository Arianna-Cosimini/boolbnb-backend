<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    //
    // public function index(Request $request) {

    //     // values of request
    //     $filters = $request->all();

    //     //default command to set 20 km
    //     /* $radius = $filters['radius'] ?? 20000; */

    //     $query = Apartment::selectRaw("*, ST_Distance_Sphere(POINT({$filters['lon']}, {$filters['lat']}), POINT(`longitude`, `latitude`)) AS `distance`");

    //     if(isset($filters['room_number'])){
    //         $query->where('room_number' , '>=' ,$filters['room_number']) ;
    //     }

    //     if(isset($filters['bed_number'])) {
    //         $query->where('bed_number' , '>=' ,$filters['bed_number']) ;
    //     }

    //     $apartments = $query->get();

    //     return response()->json([
    //         "success" => true,
    //         "results" => $apartments,
    //     ]);


       
    // }

    public function index(Request $request)
{
    $lat = 44.4949;
    $lon = 11.3426;
    $filters = $request->all();
    $lat = $request->input('lat', $lat);
    $lon = $request->input('lon', $lon);
    $radius = $filters['radius'] ?? 20000;

    $query = Apartment::select('apartments.*')
    ->selectRaw("(6371 * acos(cos(radians($lat)) * cos(radians(latitude)) * cos(radians(longitude) - radians($lon)) + sin(radians($lat)) * sin(radians(latitude)))) AS distance")
    ->with(['user', 'message', 'view', 'services', 'categories', 'sponsorships']);
    
    if(isset($filters['room_number'])){
        $query->where('room_number' , '>=' ,$filters['room_number']) ;
    }

    if(isset($filters['bed_number'])) {
        $query->where('bed_number' , '>=' ,$filters['bed_number']) ;
    }

    if ($request->has('services')) {
        $serviceIds = explode(',', $request->services);
        foreach ($serviceIds as $serviceId) {
            $query->whereHas('services', function ($q) use ($serviceId) {
                $q->where('services.id', $serviceId);
            });
        }
    }

    $query->having('distance', '<', $radius);
    $query->orderBy('distance');

    $apartments = $query->get();

    // $apartments->transform(function ($apartment) {
    //     if ($apartment->cover) {
    //         $apartment->cover = url('storage/' . $apartment->cover);
    //     }
    //     return $apartment;
    // });

    return $apartments;
}
}
