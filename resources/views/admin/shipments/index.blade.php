<x-layout title="Shipments">
    <x-slot:actions>
        <a href="{{ route('admin.shipments.create') }}"
           class="rounded-lg bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 font-medium">
            + New Shipment
        </a>
    </x-slot:actions>

    <div class="bg-white rounded-xl shadow overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-left text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3">Tracking</th>
                    <th class="px-4 py-3">Customer</th>
                    <th class="px-4 py-3">Route</th>
                    <th class="px-4 py-3">Weight</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse ($shipments as $shipment)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-mono">{{ $shipment->tracking_number }}</td>
                        <td class="px-4 py-3">
                            {{ $shipment->customer_name }}
                            <div class="text-gray-500 text-xs">{{ $shipment->customer_phone }}</div>
                        </td>
                        <td class="px-4 py-3">{{ $shipment->origin }} → {{ $shipment->destination }}</td>
                        <td class="px-4 py-3">{{ $shipment->weight }} kg</td>
                        <td class="px-4 py-3"><x-status-badge :status="$shipment->status" /></td>
                        <td class="px-4 py-3 text-right whitespace-nowrap">
                            <a href="{{ route('admin.shipments.show', $shipment) }}" class="text-gray-600 hover:underline">View</a>
                            <a href="{{ route('admin.shipments.edit', $shipment) }}" class="text-blue-600 hover:underline ml-3">Edit</a>
                            <form action="{{ route('admin.shipments.destroy', $shipment) }}" method="POST" class="inline ml-3"
                                  onsubmit="return confirm('Delete this shipment?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-500">No shipments yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $shipments->links() }}</div>
</x-layout>