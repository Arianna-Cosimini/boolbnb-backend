<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SponsorshipController;
use App\Http\Controllers\UserDatasController;
use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/admin', 301);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(
        function () {

            // Route::get('/admin',[DashboardController::class,'index'])->name('admin');
            // Route::get('/users',[DashboardController::class,'users'])->name('users');
        
            Route::get('/', [DashboardController::class, 'index'])->name('index');
            Route::resource('apartments', ApartmentController::class)->parameters(['apartments' => 'apartment:slug']);

            Route::get('users', [DashboardController::class, 'users'])->name('users');

            //rotta per le views
            Route::resource('views', ViewController::class);

            //rotta per i messagges
            Route::resource('messages', MessageController::class);
            //rotta per il singolo messaggio
            Route::get('messages/{id}', [MessageController::class, 'show'])->name('messages.show');


            //rotta per la sponsorizzazione
            Route::resource('sponsorships', SponsorshipController::class, ['except' => ['show']]);
            //rotta per la modifica della sponsorizzazione
            Route::get('sponsorships/{apartment_id}/{sponsorship_id}/edit', [SponsorshipController::class, 'edit'])->name('admin.sponsorships.edit');
            //rotta per l'aggiornamento della sponsorizzazione
            Route::put('sponsorships/{apartment_id}/{sponsorship_id}', [SponsorshipController::class, 'update'])->name('admin.sponsorships.update');
        }
    );

require __DIR__ . '/auth.php';
