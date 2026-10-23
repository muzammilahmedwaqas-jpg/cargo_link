@props(['title' => 'Admin'])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} — Shipment Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-100 text-gray-800">

    <nav class="bg-slate-900 text-white">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ route('admin.shipments.index') }}" class="font-bold text-lg">📦 Shipment Admin</a>
            <div class="flex items-center gap-5 text-sm">
                <a href="{{ route('admin.shipments.index') }}"
                   class="{{ request()->routeIs('admin.shipments.*') ? 'text-white' : 'text-slate-400' }} hover:text-white">
                    Shipments
                </a>
                <a href="{{ route('admin.reports.daily') }}"
                   class="{{ request()->routeIs('admin.reports.*') ? 'text-white' : 'text-slate-400' }} hover:text-white">
                    Daily Report
                </a>

                @auth
                    <span class="text-slate-500">|</span>
                    <span class="text-slate-300">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button class="text-slate-400 hover:text-red-400">Log out</button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">{{ $title }}</h1>
            {{ $actions ?? '' }}
        </div>

        @if (session('success'))
            <div class="mb-6 rounded-lg bg-green-100 border border-green-300 text-green-800 px-4 py-3">
                {{ session('success') }}
            </div>
        @endif

        {{ $slot }}
    </main>
</body>
</html>