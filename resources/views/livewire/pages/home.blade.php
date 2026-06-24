<div class="space-y-6 p-6 md:p-8">
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Selamat datang kembali, {{ $currentUsername }}!</h2>
            <p class="text-sm text-gray-500 mt-1">Semoga harimu menyenangkan di PT. Duta Listrik Graha Prima! Berikut adalah ringkasan aktivitas terbaru di sistem.</p>
        </div>
        <div class="hidden sm:block text-right">
            <p class="text-sm font-semibold text-[#3e77f4]">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
        
        <div class="lg:col-span-1">
            <x-card>
                <div class="flex flex-col items-center text-center pt-4 pb-2">
                    <div class="relative">
                        <div
                            class="rounded-full border-4 border-white shadow-md bg-gray-100"
                            x-data="{ name: '{{ $currentUsername }}' }"
                            x-html="avatarHTML(name, 85)"
                        ></div>
                    </div>

                    <h3 class="text-xl font-bold text-gray-800 mt-4 mb-1">{{ $currentUsername }}</h3>
                    <p class="text-xs text-gray-400 mb-6">PT Duta Listrik Graha Prima</p>
                </div>
            </x-card>
        </div>

        <div class="lg:col-span-2">
            <livewire:components.history-list/>
        </div>

    </div>
</div>