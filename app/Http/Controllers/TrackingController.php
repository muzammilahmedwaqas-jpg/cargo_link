<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index(Request $request)
    {
        $shipments = null; // null = "nobody has searched yet"

        if ($request->filled('phone')) {
            $validated = $request->validate([
                'phone' => ['required', 'regex:/^[0-9+\-\s]{7,20}$/'],
            ], [
                'phone.regex' => 'Please enter a valid phone number, e.g. 03001234567.',
            ]);

            $shipments = Shipment::forPhone($validated['phone'])
                ->latest()   // newest first
                ->get();     // a Collection, possibly empty
        }

        return view('tracking.index', [
            'shipments' => $shipments,
            'phone'     => $request->input('phone'),
        ]);
    }
}
