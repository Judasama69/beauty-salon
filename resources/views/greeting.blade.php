<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Elite Beauty Salon</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <div class="flex items-center justify-center h-screen bg-gray-100">
        <div class="text-center p-10 bg-white rounded-3xl shadow-2xl border-t-8 border-pink-400">
            <h1 class="text-4xl font-black mb-4 {{ $mood }}">
                {{ $greeting }}
            </h1>

            <p class="text-gray-500 italic mb-6">
                Welcome back to Elite Beauty Salon. Ready for a glow-up?
            </p>

            <a href="{{ route('services.index') }}"
               class="bg-pink-500 text-white px-8 py-3 rounded-full font-bold hover:bg-pink-600 transition">
                Browse Services
            </a>

            <a href="{{ url('/') }}"
               class="bg-gray-300 text-gray-700 px-8 py-3 rounded-full font-bold hover:bg-gray-400 transition ml-4">
                Home
            </a>
        </div>
    </div>
</body>
</html>
