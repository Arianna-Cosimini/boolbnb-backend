<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SponsorshipController;
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
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('index');

        // Braintree
        Route::get('/sponsorships/payment/token', [SponsorshipController::class, 'getClientToken'])->name('payment.token');
        Route::post('/sponsorships/payment/process', [SponsorshipController::class, 'processPayment'])->name('payment.process');

        Route::resource('apartments', ApartmentController::class)->parameters(['apartments' => 'apartment:slug']);

        Route::get('users', [DashboardController::class, 'users'])->name('users');

        // Rotta per le views
        Route::resource('visited', ViewController::class);

        // Rotta per i messaggi
        Route::resource('messages', MessageController::class);
        Route::delete('admin/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

        // Rotta per il singolo messaggio
        Route::get('messages/{id}', [MessageController::class, 'show'])->name('messages.show');

        // Rotta per la sponsorizzazione
        Route::resource('sponsorships', SponsorshipController::class, ['except' => ['show']]);
        // Rotta per la modifica della sponsorizzazione
        Route::get('sponsorships/{apartment_id}/{sponsorship_id}/edit', [SponsorshipController::class, 'edit'])->name('sponsorships.edit');
        // Rotta per l'aggiornamento della sponsorizzazione
        Route::put('sponsorships/{apartment_id}/{sponsorship_id}', [SponsorshipController::class, 'update'])->name('sponsorships.update');
    });

require __DIR__ . '/auth.php';
