<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Durian Runtuh - Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <!-- Container -->
    <div class="bg-[#f7f7f7]">
        <main class="flex items-center justify-center  h-screen w-full">
            {{ $slot }}
        </main>
    </div>
    @livewireScripts
</body>
</html>