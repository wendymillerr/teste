<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} {!! empty($subtitle) ? '' : ' &vellip; ' . $subtitle !!}</title>
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">

    <header class="bg-white shadow mb-6">
        <div class="max-w-6xl mx-auto p-4 flex justify-between">
            <a href="{{ route('home') }}" class="font-bold text-xl">Blog</a>
        </div>
    </header>

    <main class="max-w-6xl mx-auto p-4">
        {{ $slot }}
    </main>

</body>
</html>
