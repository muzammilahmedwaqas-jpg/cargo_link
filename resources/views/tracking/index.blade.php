<x-public-layout title="Track Your Shipments">

    {{-- Search form (GET, so no @csrf needed) --}}
    <div class="bg-white rounded-2xl shadow p-8 mb-8">
        <h1 class="text-2xl font-bold mb-1">Track Your Shipments</h1>
        <p class="text-gray-500 mb-6">Enter the phone number you used when booking.</p>

        <form method="GET" action="{{ route('tracking.index') }}" class="flex flex-col sm:flex-row gap-3">
            <div class="flex-1">
                <input type="tel" name="phone" value="{{ $phone }}" placeholder="03001234567"
                       class="w-full rounded-lg border px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500
                              {{ $errors->has('phone') ? 'border-red-500' : 'border-gray-300' }}">
                @error('phone')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit"
                    class="rounded-lg bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 font-semibold">
                Track
            </button>
        </form>
    </div>

    {{-- State 2 & 3: only when a search has happened --}}
    @if (! is_null($shipments))

        @if ($shipments->isEmpty())
            {{-- Empty state --}}
            <div class="bg-white rounded-2xl shadow p-10 text-center">
                <div class="text-5xl mb-3">🔍</div>
                <h2 class="text-lg font-semibold">No shipments found</h2>
                <p class="text-gray-500 mt-1">
                    We couldn't find any shipments for <span class="font-mono">{{ $phone }}</span>.
                    Check the number, or
                    <a href="{{ route('booking.create') }}" class="text-blue-600 hover:underline">book a new shipment</a>.
                </p>
            </div>
        @else
            {{-- Results --}}
            <p class="text-gray-600 mb-4">
                Found {{ $shipments->count() }} {{ Str::plural('shipment', $shipments->count()) }}
            </p>

            <div class="space-y-4">
                @foreach ($shipments as $shipment)
                    <div class="bg-white rounded-xl shadow p-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div>
                            <p class="font-mono text-sm text-gray-500">{{ $shipment->tracking_number }}</p>
                            <p class="text-lg font-semibold">
                                {{ $shipment->origin }} → {{ $shipment->destination }}
                            </p>
                            <p class="text-sm text-gray-500">
                                Booked {{ $shipment->created_at->format('d M Y') }}
                                ({{ $shipment->created_at->diffForHumans() }})
                                · {{ $shipment->weight }} kg
                            </p>
                        </div>
                        <x-status-badge :status="$shipment->status" />
                    </div>
                @endforeach
            </div>
        @endif

    @endif
</x-public-layout>