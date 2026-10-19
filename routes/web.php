<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ShipmentController;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('shipments', ShipmentController::class);
});

Route::get('/book', [BookingController::class, 'create'])->name('booking.create');
Route::post('/book', [BookingController::class, 'store'])->middleware('throttle:10,1')->name('booking.store');

Route::redirect('/', '/book');