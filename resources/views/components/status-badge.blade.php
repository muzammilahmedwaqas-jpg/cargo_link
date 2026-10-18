@props(['status'])

@php
    $colors = [
        'pending'    => 'bg-yellow-100 text-yellow-800',
        'in_transit' => 'bg-blue-100 text-blue-800',
        'delivered'  => 'bg-green-100 text-green-800',
        'cancelled'  => 'bg-red-100 text-red-800',
    ];
@endphp

<span class="inline-block rounded-full px-3 py-1 text-xs font-semibold {{ $colors[$status->value] ?? 'bg-gray-100' }}">
    {{ $status->label() }}
</span>