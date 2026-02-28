<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Our Services</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold my-8">Our Services</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($services as $service)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-2xl font-bold mb-2">{{ $service->name }}</h2>
                    <p class="text-gray-700 mb-4">{{ $service->description }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-bold">₱{{ number_format($service->price, 2) }}</span>
                        <span class="text-gray-600">{{ $service->duration_minutes }} minutes</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
