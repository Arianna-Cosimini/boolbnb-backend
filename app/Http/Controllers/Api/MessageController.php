<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // memorized the new-message in the db
    // use store
    public function store() {
        return response()->json([
            'success' => true
        ]);
    }
}
