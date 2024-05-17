<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index(){
        // ci restituisc tutti gli appartamenti dal db
        return "ciao";
    }
}
