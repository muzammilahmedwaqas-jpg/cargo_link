<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ShipmentController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TrackingController;

Route::redirect('/', '/book');

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('login', [AuthController::class, 'login'])
            ->middleware('throttle:5,1')
            ->name('login.attempt');
    });

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::redirect('/', '/admin/shipments');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        Route::resource('shipments', ShipmentController::class);
        Route::patch('shipments/{shipment}/status', [ShipmentController::class, 'updateStatus'])
            ->name('shipments.status.update');
        Route::get('reports/daily', [ReportController::class, 'daily'])->name('reports.daily');
    });
});

Route::get('/book', [BookingController::class, 'create'])->name('booking.create');
Route::post('/book', [BookingController::class, 'store'])->middleware('throttle:10,1')->name('booking.store');

Route::get('/track', [TrackingController::class, 'index'])->middleware('throttle:30,1')->name('tracking.index');
