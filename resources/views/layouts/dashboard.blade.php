<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <!-- Container -->
    <div class="grid bg-[#f7f7f7] grid-cols-[300px_1fr]">
        <!-- Sidebar -->
        <livewire:components.sidebar/>

        <!-- Container -->
        <div class="flex flex-col min-w-full min-h-screen z-10 overflow-x-hidden">
            <!-- Navbar -->
            <nav class="bg-[#3e77f4] flex items-center min-h-16 max-h-16 px-6 sticky top-0 z-50">
                <!-- <div @click="sidebar = !sidebar" class="w-10 h-10 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                        <path fill="rgb(255, 255, 255)" d="M96 160C96 142.3 110.3 128 128 128L512 128C529.7 128 544 142.3 544 160C544 177.7 529.7 192 512 192L128 192C110.3 192 96 177.7 96 160zM96 320C96 302.3 110.3 288 128 288L512 288C529.7 288 544 302.3 544 320C544 337.7 529.7 352 512 352L128 352C110.3 352 96 337.7 96 320zM544 480C544 497.7 529.7 512 512 512L128 512C110.3 512 96 497.7 96 480C96 462.3 110.3 448 128 448L512 448C529.7 448 544 462.3 544 480z"/>
                    </svg>
                </div> -->
            </nav>
            <main class="flex-1">
                {{ $slot }}
            </main>
        </div>
    </div>
    @livewireScripts
</body>
</html>