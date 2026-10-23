<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — Cargo Link</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-900 flex items-center justify-center px-4">

    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <p class="text-4xl">📦</p>
            <h1 class="text-2xl font-bold text-white mt-2">Cargo Link Admin</h1>
            <p class="text-slate-400 text-sm mt-1">Sign in to manage shipments</p>
        </div>

        <div class="bg-white rounded-2xl shadow-xl p-8">
            @if (session('success'))
                <div class="mb-5 rounded-lg bg-green-100 border border-green-300 text-green-800 px-4 py-3 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.attempt') }}">
                @csrf

                <x-form.input name="email" label="Email" type="email" autofocus autocomplete="username" />
                <x-form.input name="password" label="Password" type="password" autocomplete="current-password" />

                <label class="flex items-center gap-2 text-sm text-gray-600 mb-6">
                    <input type="checkbox" name="remember" class="rounded border-gray-300">
                    Remember me
                </label>

                <button type="submit"
                        class="w-full rounded-lg bg-blue-600 hover:bg-blue-700 text-white py-3 font-semibold">
                    Log in
                </button>
            </form>
        </div>

        <p class="text-center mt-6">
            <a href="{{ route('booking.create') }}" class="text-slate-400 hover:text-white text-sm">← Back to Cargo Link</a>
        </p>
    </div>
</body>
</html>
