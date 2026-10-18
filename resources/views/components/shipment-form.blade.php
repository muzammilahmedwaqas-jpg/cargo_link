@props(['action', 'method' => 'POST', 'shipment' => null, 'button' => 'Save'])

@php
    $statusOptions = collect(\App\Enums\ShipmentStatus::cases())
        ->mapWithKeys(fn ($s) => [$s->value => $s->label()])
        ->all();
@endphp

<form method="POST" action="{{ $action }}" class="bg-white rounded-xl shadow p-6 max-w-2xl">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="grid md:grid-cols-2 gap-x-4">
        <x-form.input name="customer_name" label="Customer name" :value="$shipment?->customer_name" />
        <x-form.input name="customer_phone" label="Phone" :value="$shipment?->customer_phone" placeholder="03001234567" />
        <x-form.input name="origin" label="Origin" :value="$shipment?->origin" />
        <x-form.input name="destination" label="Destination" :value="$shipment?->destination" />
        <x-form.input name="weight" label="Weight (kg)" type="number" step="0.01" :value="$shipment?->weight" />
        <x-form.select name="status" label="Status" :options="$statusOptions" :selected="$shipment?->status?->value ?? 'pending'" />
    </div>

    <div class="flex gap-3 mt-4">
        <button type="submit" class="rounded-lg bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 font-medium">
            {{ $button }}
        </button>
        <a href="{{ route('admin.shipments.index') }}" class="rounded-lg border border-gray-300 px-5 py-2 hover:bg-gray-50">
            Cancel
        </a>
    </div>
</form>