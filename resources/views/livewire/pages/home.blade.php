<div class="space-y-6 p-6 md:p-8">
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Selamat datang kembali, Enji!</h2>
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
                        <img class="w-24 h-24 rounded-full border-4 border-white shadow-md bg-gray-100 object-cover" src="https://ui-avatars.com/api/?name=Enji&background=3e77f4&color=fff&size=128" alt="Profile">
                        <span class="absolute bottom-2 right-1 w-5 h-5 bg-green-500 border-4 border-white rounded-full"></span>
                    </div>

                    <h3 class="text-xl font-bold text-gray-800 mt-4">Enji</h3>
                    <p class="text-sm text-[#3e77f4] font-semibold mb-1">Administration Department</p>
                    <p class="text-xs text-gray-400 mb-6">PT Duta Listrik Graha Prima</p>

                    <div class="w-full pt-5 border-t border-gray-100 flex justify-between items-center text-sm">
                        <span class="text-gray-500 font-medium">Status Akun</span>
                        <span class="px-3 py-1 bg-green-100 text-green-700 font-bold rounded-full text-[11px] uppercase tracking-wider">Aktif</span>
                    </div>
                </div>
            </x-card>
        </div>

        <div class="lg:col-span-2">
            <x-card>
                <div class="border-b border-gray-100 pb-4 mb-4 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-800">Aktivitas Terbaru</h3>
                    <span class="text-xs font-semibold text-[#3e77f4] bg-blue-50 px-2 py-1 rounded">Real-time</span>
                </div>

                <div class="space-y-5">
                    
                    <div class="flex items-start gap-4">
                        <img class="w-10 h-10 rounded-full border-2 border-white shadow-sm bg-gray-100" src="https://ui-avatars.com/api/?name=Enji&background=3e77f4&color=fff" alt="Avatar">
                        <div class="flex-1 pb-4 border-b border-gray-50">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-sm text-gray-800">
                                        <span class="font-bold text-gray-900">Enji</span> menambahkan <span class="font-semibold">Master Merk</span> baru.
                                    </p>
                                    <p class="text-sm font-bold text-[#3e77f4] mt-1 bg-blue-50 inline-block px-2 py-0.5 rounded">FUJI</p>
                                </div>
                                <span class="text-xs font-medium text-gray-400 whitespace-nowrap">Baru saja</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <img class="w-10 h-10 rounded-full border-2 border-white shadow-sm bg-gray-100" src="https://ui-avatars.com/api/?name=Sadewa&background=f43e3e&color=fff" alt="Avatar">
                        <div class="flex-1 pb-4 border-b border-gray-50">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-sm text-gray-800">
                                        <span class="font-bold text-gray-900">Sadewa</span> membuat <span class="font-semibold">Tipe & Item</span> baru.
                                    </p>
                                    <p class="text-sm font-bold text-[#3e77f4] mt-1 bg-blue-50 inline-block px-2 py-0.5 rounded">BT3-1600P/41600E PA1 CM</p>
                                </div>
                                <span class="text-xs font-medium text-gray-400 whitespace-nowrap">15 mnt lalu</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <img class="w-10 h-10 rounded-full border-2 border-white shadow-sm bg-gray-100" src="https://ui-avatars.com/api/?name=Ani&background=3ef48a&color=fff" alt="Avatar">
                        <div class="flex-1 pb-4 border-b border-gray-50">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-sm text-gray-800">
                                        <span class="font-bold text-gray-900">Ani</span> menambahkan <span class="font-semibold">Jenis Barang</span>.
                                    </p>
                                    <p class="text-sm font-bold text-[#3e77f4] mt-1 bg-blue-50 inline-block px-2 py-0.5 rounded">ACB</p>
                                </div>
                                <span class="text-xs font-medium text-gray-400 whitespace-nowrap">1 jam lalu</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <img class="w-10 h-10 rounded-full border-2 border-white shadow-sm bg-gray-100" src="https://ui-avatars.com/api/?name=Zidan&background=f49a3e&color=fff" alt="Avatar">
                        <div class="flex-1">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="text-sm text-gray-800">
                                        <span class="font-bold text-gray-900">Zidan</span> memperbarui <span class="font-semibold">Master Merk</span>.
                                    </p>
                                    <p class="text-sm font-bold text-[#3e77f4] mt-1 bg-blue-50 inline-block px-2 py-0.5 rounded">SCHNEIDER</p>
                                </div>
                                <span class="text-xs font-medium text-gray-400 whitespace-nowrap">Kemarin, 14:30</span>
                            </div>
                        </div>
                    </div>

                </div>
                
                <div class="mt-6 text-center">
                    <button class="text-sm font-bold text-[#3e77f4] hover:text-[#3669d9] transition-colors">Lihat lebih banyak ↓</button>
                </div>
            </x-card>
        </div>

    </div>
</div>