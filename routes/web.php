<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ShipmentController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TrackingController;

Route::redirect('/', '/book');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('shipments', ShipmentController::class);
});

Route::get('/book', [BookingController::class, 'create'])->name('booking.create');
Route::post('/book', [BookingController::class, 'store'])->middleware('throttle:10,1')->name('booking.store');

Route::get('/track', [TrackingController::class, 'index'])->middleware('throttle:30,1')->name('tracking.index');