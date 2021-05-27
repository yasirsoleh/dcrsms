<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::prefix('/register')->group(function () {
    Route::get('/staff', [RegistrationController::class, 'registerStaff'])
        ->middleware('guest')
        ->name('register.staff');

    Route::post('/staff', [RegistrationController::class, 'createStaff'])
        ->middleware('guest');

    Route::get('/', [RegistrationController::class, 'index'])
        ->name('register');

    Route::get('/customer', [RegistrationController::class, 'registerCustomer'])
        ->middleware('guest')
        ->name('register.customer');

    Route::post('/customer', [RegistrationController::class, 'createCustomer'])
        ->middleware('guest');

    Route::get('/rider', [RegistrationController::class, 'registerRider'])
        ->middleware('guest')
        ->name('register.rider');

    Route::post('/rider', [RegistrationController::class, 'createRider'])
        ->middleware('guest');
});