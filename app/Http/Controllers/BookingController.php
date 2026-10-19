<?php
namespace App\Http\Controllers;

use App\Enums\ShipmentStatus;
use App\Http\Requests\StoreBookingRequest;
use App\Models\Shipment;

class BookingController extends Controller
{
    public function create()
    {
        return view('booking.create');
    }

    public function store(StoreBookingRequest $request)
    {
        $shipment = Shipment::create([
            ...$request->validated(),
            'status' => ShipmentStatus::Pending,
        ]);

        return redirect()
            ->route('booking.create')
            ->with('success', 'Your shipment has been booked!')
            ->with('tracking', $shipment->tracking_number);
    }
}