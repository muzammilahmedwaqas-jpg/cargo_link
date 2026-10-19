<x-public-layout title="Book a Shipment">

    @if (session('success'))
        <div class="mb-6 rounded-xl bg-green-50 border border-green-300 p-5">
            <p class="font-semibold text-green-800">✅ {{ session('success') }}</p>
            <p class="text-green-700 mt-1">
                Your tracking number is
                <span class="font-mono font-bold">{{ session('tracking') }}</span>.
                Please save it to track your shipment.
            </p>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow p-8">
        <h1 class="text-2xl font-bold mb-1">Book a Shipment</h1>
        <p class="text-gray-500 mb-6">Fill in the details below and we'll take care of the rest.</p>

        @if ($errors->any())
            <div class="mb-6 rounded-lg bg-red-50 border border-red-300 text-red-700 px-4 py-3 text-sm">
                Please fix the {{ $errors->count() }} highlighted {{ Str::plural('field', $errors->count()) }} below.
            </div>
        @endif

        <form method="POST" action="{{ route('booking.store') }}">
            @csrf

            <h2 class="font-semibold text-gray-700 mb-3">Your details</h2>
            <div class="grid md:grid-cols-2 gap-x-4">
                <x-form.input name="customer_name" label="Full name" placeholder="Muzammil Ahmed" />
                <x-form.input name="customer_phone" label="Phone number" type="tel" placeholder="03001234567" />
            </div>

            <h2 class="font-semibold text-gray-700 mb-3 mt-2">Shipment details</h2>
            <div class="grid md:grid-cols-3 gap-x-4">
                <x-form.input name="origin" label="From (city)" placeholder="Karachi" />
                <x-form.input name="destination" label="To (city)" placeholder="Lahore" />
                <x-form.input name="weight" label="Weight (kg)" type="number" step="0.01" min="0.1" placeholder="5.00" />
            </div>

            <button type="submit"
                    class="mt-4 w-full md:w-auto rounded-lg bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 font-semibold">
                Book Shipment
            </button>
        </form>
    </div>
</x-public-layout>