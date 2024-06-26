<?php

use App\Http\Controllers\Api\ApartmentController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\FilterController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\ViewController;
use App\Http\Controllers\SponsorshipController;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/apartments', [ApartmentController::class, 'index']);

//rotta per la show singola
Route::get('/apartments/{slug}', [ApartmentController::class, 'show']);

//rotta per le categorie
Route::get('/categories', [CategoryController::class, 'index']);

//rotta per la store dei messages
Route::post('/new-message', [MessageController::class, 'store']);

// rotta per i filtri
Route::get('/filter', [FilterController::class, 'index']);

// rotta per i filtri
Route::post('/sponsorships', [SponsorshipController::class, 'create']);

//Rotta per le visualizzazioni
Route::post('/views', [ViewController::class, 'store']);
