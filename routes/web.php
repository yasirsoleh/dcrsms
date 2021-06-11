<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\PickUpController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\RepairItemController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
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

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

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
    Route::get('/', [AccountController::class, 'index'])
        ->middleware('auth')
        ->name('account.index');

    Route::post('/edit', [AccountController::class,'editAccount'])
        ->middleware('auth')
        ->name('account.edit');

    Route::put('/', [AccountController::class, 'update'])
        ->name('account.update');

    Route::middleware(['auth','role:staff'])->group(function () {
        Route::prefix('/list')->group(function () {
            Route::get('/customer', [AccountController::class,'viewAllCustomerAccount'])
                ->name('account.list.customer');
            
            Route::get('/rider', [AccountController::class,'viewAllRiderAccount'])
                ->name('account.list.rider');

        });
    });

    Route::get('/customer/{customer}/ban', [AccountController::class,'customer_ban'])
        ->name('account.customer_ban');
    Route::get('/customer/{customer}/unban', [AccountController::class,'customer_unban'])
        ->name('account.customer_unban');
    Route::get('/rider/{rider}/ban', [AccountController::class,'rider_ban'])
        ->name('account.rider_ban');
    Route::get('/rider/{rider}/unban', [AccountController::class,'rider_unban'])
        ->name('account.rider_unban');
    Route::get('/rider/{rider}/approve', [AccountController::class,'rider_unban'])
        ->name('account.rider_approve');
    Route::get('/customer/{customer}/destroy', [AccountController::class,'destroy_customer'])
        ->name('account.destroy_customer');
});

Route::prefix('/service_request')->group(function () {
    Route::get('/', [ServiceRequestController::class, 'index'])
        ->name('service_request.index');
    Route::get('/create', [ServiceRequestController::class, 'create'])
        ->name('service_request.create');
    Route::get('/{service_request}/edit', [ServiceRequestController::class, 'edit'])
        ->name('service_request.edit');
    Route::put('/{service_request}', [ServiceRequestController::class, 'update'])
        ->name('service_request.update');
    Route::delete('/{service_request}', [ServiceRequestController::class, 'destroy'])
        ->name('service_request.delete');
    Route::post('/', [ServiceRequestController::class, 'store'])
        ->name('service_request.store');
    Route::get('/{service_request}', [ServiceRequestController::class, 'show'])
        ->name('service_request.show');
    Route::get('/{service_request}/staff_approve', [ServiceRequestController::class,'staff_approve'])
        ->name('service_request.staff_approve');
    Route::put('/{service_request}/staff_not_approve', [ServiceRequestController::class,'staff_not_approve'])
        ->name('service_request.staff_not_approve');
    Route::get('/{service_request}/customer_approve', [ServiceRequestController::class,'customer_approve'])
        ->name('service_request.customer_approve');
    Route::get('/{service_request}/customer_not_approve', [ServiceRequestController::class,'customer_not_approve'])
        ->name('service_request.customer_not_approve');
    Route::get('/{service_request}/rejection_reason', [ServiceRequestController::class,'rejection_reason'])
        ->name('service_request.rejection_reason');
});

Route::prefix('/quotation')->group(function () {
    Route::get('/', [QuotationController::class, 'index'])
        ->name('quotation.index');
    Route::get('/create/{service_request}', [QuotationController::class, 'create'])
        ->name('quotation.create');
    Route::post('/', [QuotationController::class, 'store'])
        ->name('quotation.store');
    Route::get('/{service_request}', [QuotationController::class, 'show'])
        ->name('quotation.show');
    Route::get('/{quotation}/edit', [QuotationController::class, 'edit'])
        ->name('quotation.edit');
    Route::put('/{quotation}', [QuotationController::class, 'update'])
        ->name('quotation.update');
    Route::delete('/{quotation}/delete', [QuotationController::class, 'destroy'])
        ->name('quotation.delete');
});

Route::prefix('/pick_up')->group(function () {
    Route::get('/', [PickUpController::class, 'index'])
        ->name('pick_up.index');
    Route::get('/create/{service_request}', [PickUpController::class, 'create'])
        ->name('pick_up.create');
    Route::post('/', [PickUpController::class, 'store'])
        ->name('pick_up.store');
    Route::get('/{pick_up}', [PickUpController::class, 'show'])
        ->name('pick_up.show');
    Route::get('/{pick_up}/edit', [PickUpController::class, 'edit'])
        ->name('pick_up.edit');
    Route::put('/{pick_up}', [PickUpController::class, 'update'])
        ->name('pick_up.update');
    Route::delete('/{pick_up}', [PickUpController::class, 'destroy'])
        ->name('pick_up.delete');
    Route::get('/{pick_up}/rider_accept}', [PickUpController::class, 'rider_accept'])
        ->name('pick_up.rider_accept');
});

Route::prefix('/repair')->group(function () {
    Route::get('/', [RepairController::class, 'index'])
        ->name('repair.index');
    Route::get('/create/{service_request}', [RepairController::class, 'create'])
        ->name('repair.create');
    Route::post('/', [RepairController::class, 'store'])
        ->name('repair.store');
    Route::get('/{repair}', [RepairController::class, 'show'])
        ->name('repair.show');
    Route::get('/{repair}/edit', [RepairController::class, 'edit'])
        ->name('repair.edit');
    Route::put('/{repair}', [RepairController::class, 'update'])
        ->name('repair.update');
    Route::delete('/{repair}', [RepairController::class, 'destroy'])
        ->name('repair.delete');
    Route::get('/{repair}/add_item', [RepairController::class, 'add_item'])
        ->name('repair.add_item');
    Route::post('/{repair}/add_item', [RepairController::class, 'store_item'])
        ->name('repair.store_item');
    Route::delete('/destroy_item/{repair_item}', [RepairController::class, 'destroy_item'])
        ->name('repair.destroy_item');
    Route::put('/{repair}/reason', [RepairController::class, 'reason'])
        ->name('repair.reason');
});

Route::prefix('/delivery')->group(function () {
    Route::get('/', [DeliveryController::class, 'index'])
        ->name('delivery.index');
    Route::get('/create/{service_request}', [DeliveryController::class, 'create'])
        ->name('delivery.create');
    Route::post('/', [DeliveryController::class, 'store'])
        ->name('delivery.store');
    Route::get('/{delivery}', [DeliveryController::class, 'show'])
        ->name('delivery.show');
    Route::get('/{delivery}/edit', [DeliveryController::class, 'edit'])
        ->name('delivery.edit');
    Route::put('/{delivery}', [DeliveryController::class, 'update'])
        ->name('delivery.update');
    Route::delete('/{delivery}', [DeliveryController::class, 'destroy'])
        ->name('delivery.delete');
    Route::get('/{delivery}/rider_accept}', [DeliveryController::class, 'rider_accept'])
        ->name('delivery.rider_accept');
});

Route::prefix('/payment')->group(function () {
    Route::get('/', [PaymentController::class, 'index'])
        ->name('payment.index');
    Route::get('/create/{service_request}', [PaymentController::class, 'create'])
        ->name('payment.create');
    Route::post('/', [PaymentController::class, 'store'])
        ->name('payment.store');
    Route::get('/{payment}', [PaymentController::class, 'show'])
        ->name('payment.show');
    Route::get('/{payment}/edit', [PaymentController::class, 'edit'])
        ->name('payment.edit');
    Route::put('/{payment}', [PaymentController::class, 'update'])
        ->name('payment.update');
    Route::delete('/{repair}', [PaymentController::class, 'destroy'])
        ->name('payment.delete');
    Route::get('/{payment}/cash_on_delivery', [PaymentController::class, 'cash_on_delivery'])
        ->name('payment.cash_on_delivery');
});