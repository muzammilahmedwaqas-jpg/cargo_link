<x-layout :title="'Edit ' . $shipment->tracking_number">
    <x-shipment-form
        :action="route('admin.shipments.update', $shipment)"
        method="PUT"
        :shipment="$shipment"
        button="Update Shipment" />
</x-layout>