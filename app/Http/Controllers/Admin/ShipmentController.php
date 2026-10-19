<?php
namespace App\Http\Controllers\Admin;

use App\Enums\ShipmentStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShipmentRequest;
use App\Models\Shipment;
use Illuminate\Support\Str;

class ShipmentController extends Controller
{
    public function index()
    {
        $shipments = Shipment::with('creator')->latest()->paginate(10);
        return view('admin.shipments.index', compact('shipments'));
    }

    public function create()
    {
        return view('admin.shipments.create');
    }

    public function store(StoreShipmentRequest $request)
    {
        Shipment::create($request->validated() + [
            'created_by' => auth()->id(),
        ]);
        return redirect()->route('admin.shipments.index')->with('success', 'Shipment created.');
    }

    public function show(Shipment $shipment)
    {
        return view('admin.shipments.show', compact('shipment'));
    }

    public function edit(Shipment $shipment)
    {
        return view('admin.shipments.edit', compact('shipment'));
    }

    public function update(StoreShipmentRequest $request, Shipment $shipment)
    {
        $shipment->update($request->validated());
        return redirect()->route('admin.shipments.index')->with('success', 'Shipment updated.');
    }

    public function destroy(Shipment $shipment)
    {
        $shipment->delete();
        return redirect()->route('admin.shipments.index')->with('success', 'Shipment deleted.');
    }
}