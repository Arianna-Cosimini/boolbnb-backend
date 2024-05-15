<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

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
            Route::resource('apartments', ApartmentController::class);

            Route::get('users', [DashboardController::class, 'users'])->name('users');

            Route::resource('views', ViewController::class);

            Route::resource('messages', MessageController::class);
        }
    );



require __DIR__ . '/auth.php';