<x-layout title="Daily Report">
    <x-slot:actions>
        <form method="GET" action="{{ route('admin.reports.daily') }}" class="flex gap-2">
            <input type="date" name="date" value="{{ $date->toDateString() }}"
                   class="rounded-lg border border-gray-300 px-3 py-2 bg-white">
            <button class="rounded-lg bg-slate-800 hover:bg-slate-900 text-white px-4 py-2">Go</button>
        </form>
    </x-slot:actions>

    <div class="flex items-center justify-between mb-6">
        <a href="{{ route('admin.reports.daily', ['date' => $date->copy()->subDay()->toDateString()]) }}"
           class="text-blue-600 hover:underline">← Previous day</a>

        <p class="text-lg font-semibold">
            {{ $date->format('l, d M Y') }}
            @if ($date->isToday()) <span class="text-sm text-blue-600">(Today)</span> @endif
        </p>

        @unless ($date->isToday())
            <a href="{{ route('admin.reports.daily', ['date' => $date->copy()->addDay()->toDateString()]) }}"
               class="text-blue-600 hover:underline">Next day →</a>
        @else
            <span></span>
        @endunless
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach ($report as $row)
            <div class="bg-white rounded-xl shadow p-6">
                <x-status-badge :status="$row['status']" />
                <p class="text-4xl font-bold mt-4">{{ $row['total'] }}</p>
                <p class="text-sm text-gray-500">{{ Str::plural('shipment', $row['total']) }}</p>
            </div>
        @endforeach
    </div>

    <div class="bg-slate-900 text-white rounded-xl p-6 mt-4 flex items-center justify-between">
        <span class="font-medium">Total shipments</span>
        <span class="text-3xl font-bold">{{ $total }}</span>
    </div>
</x-layout>