<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\View;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    //
    public function store(Request $request) {
       /*  $views = View::all();
        return compact('views'); */

        /* $apartment_id = '1';
        $ip_address = '101.56.54.208'; */

        $ip_address = $request->ip_address; 
        $apartment_id = $request->input('apartment_id'); 
       

        
        
        $isView = View::where('apartment_id', $apartment_id)
            ->where('ip_address', $ip_address)
            ->where('created_at', '>=', Carbon::now()->subDay())
            ->first();
        
       /*  if ($isView) {
            return response()->json([
                'success' => false,
                'message' => 'Questo ip ha già guardato questo appartamento nelle ultime 24 ore'
            ]);
        } */
        
        // Create a new view
        $view = new View;
        $view->apartment_id = $apartment_id;
        $view->ip_address = $ip_address;
        $view->save();

        return response()->json([
            'success' => true,
            'message' => 'La visualizzazione è stata registrata con successo',
            'data' => $view
        ]);
    }

    }

