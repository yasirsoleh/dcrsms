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

Route::middleware(['guest'])->group(function () {
    Route::prefix('/register')->group(function () {
        Route::get('/staff', [RegistrationController::class, 'registerStaff'])
            ->name('register.staff');
    
        Route::post('/staff', [RegistrationController::class, 'createStaff']);
    
        Route::get('/', [RegistrationController::class, 'index'])
            ->name('register');
    
        Route::get('/customer', [RegistrationController::class, 'registerCustomer'])
            ->name('register.customer');
    
        Route::post('/customer', [RegistrationController::class, 'createCustomer']);
    
        Route::get('/rider', [RegistrationController::class, 'registerRider'])
            ->name('register.rider');
    
        Route::post('/rider', [RegistrationController::class, 'createRider']);
    }); 
});

Route::prefix('/account')->group(function () {
    Route::get('/', [AccountController::class, 'viewAccount'])
        ->middleware('auth')
        ->name('account');

    Route::post('/edit', [AccountController::class,'editAccount'])
        ->middleware('auth')
        ->name('account.edit');

    Route::middleware(['auth','role:staff'])->group(function () {
        Route::prefix('/list')->group(function () {
            Route::get('/customer', [AccountController::class,'viewAllCustomerAccount'])
                ->name('account.list.customer');
            
            Route::get('/rider', [AccountController::class,'viewAllRiderAccount'])
                ->name('account.list.rider');

        });
    });
});

// Route Repairing Service
Route::view('/StaffSearchID', 'RepairingService.StaffSearchID');

Route::view('/StaffUpdateRequest', 'RepairingService.StaffUpdateRequest');

