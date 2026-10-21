@props(['title' => 'Cargo Link'])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} — Cargo Link</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-100 to-blue-50 text-gray-800">
    <header class="bg-white shadow-sm">
    <div class="max-w-4xl mx-auto px-4 py-4 flex items-center justify-between">
        <a href="{{ route('booking.create') }}" class="text-xl font-bold text-blue-700">📦 Cargo Link</a>
        <nav class="flex gap-5 text-sm font-medium">
            <a href="{{ route('booking.create') }}"
               class="{{ request()->routeIs('booking.*') ? 'text-blue-700' : 'text-gray-500 hover:text-gray-800' }}">Book</a>
            <a href="{{ route('tracking.index') }}"
               class="{{ request()->routeIs('tracking.*') ? 'text-blue-700' : 'text-gray-500 hover:text-gray-800' }}">Track</a>
        </nav>
    </div>
</header>

    <main class="max-w-4xl mx-auto px-4 py-10">
        {{ $slot }}
    </main>

    <footer class="text-center text-sm text-gray-500 pb-8">
        © {{ date('Y') }} Cargo Link
    </footer>
</body>
</html>