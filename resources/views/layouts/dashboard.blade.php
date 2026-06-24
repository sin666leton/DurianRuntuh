<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Durian Runtuh</title>
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
        <div class="flex flex-col min-h-screen z-10 min-w-full">
            <!-- Navbar -->
            <livewire:components.navbar/>

            <!-- Content -->
            <main class="flex-1">
                {{ $slot }}
            </main>
        </div>
    </div>
    <div x-data="{ show: false, message: '' }"
         x-on:notify.window="
            message = $event.detail.message; 
            show = true; 
            setTimeout(() => show = false, 3000)
         "
         x-show="show"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-x-8"
         x-transition:enter-end="opacity-100 transform translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-x-0"
         x-transition:leave-end="opacity-0 transform translate-x-8"
         style="display: none;"
         class="fixed bottom-8 right-8 bg-white border-l-4 border-green-500 rounded shadow-md px-5 py-3 flex items-center gap-3 z-50">
        
        <div class="bg-green-100 p-1 rounded-full text-green-500">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <span class="text-gray-700 font-medium text-sm" x-text="message"></span>
    </div>
    @livewireScripts
</body>
</html>