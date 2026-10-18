<x-layout :title="'Shipment ' . $shipment->tracking_number">
    <x-slot:actions>
        <a href="{{ route('admin.shipments.edit', $shipment) }}"
           class="rounded-lg bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 font-medium">Edit</a>
    </x-slot:actions>

    <div class="bg-white rounded-xl shadow p-6 max-w-2xl">
        <dl class="grid grid-cols-2 gap-y-4 text-sm">
            <dt class="text-gray-500">Customer</dt>     <dd>{{ $shipment->customer_name }}</dd>
            <dt class="text-gray-500">Phone</dt>        <dd>{{ $shipment->customer_phone }}</dd>
            <dt class="text-gray-500">Origin</dt>       <dd>{{ $shipment->origin }}</dd>
            <dt class="text-gray-500">Destination</dt>  <dd>{{ $shipment->destination }}</dd>
            <dt class="text-gray-500">Weight</dt>       <dd>{{ $shipment->weight }} kg</dd>
            <dt class="text-gray-500">Status</dt>       <dd><x-status-badge :status="$shipment->status" /></dd>
            <dt class="text-gray-500">Created by</dt>   <dd>{{ $shipment->creator?->name ?? '—' }}</dd>
            <dt class="text-gray-500">Created at</dt>   <dd>{{ $shipment->created_at->format('d M Y, h:i A') }}</dd>
        </dl>

        <a href="{{ route('admin.shipments.index') }}" class="inline-block mt-6 text-blue-600 hover:underline">← Back to list</a>
    </div>
</x-layout>