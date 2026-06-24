<x-card>
    <div class="border-b border-gray-100 pb-4 mb-4 flex justify-between items-center">
        <h3 class="text-lg font-bold text-gray-800">Aktivitas Terbaru</h3>
    </div>
    <div class="space-y-5">
        @foreach ($listHistory as $history)
            <div class="flex items-start gap-4">
                <div
                    class="rounded-full border-2 border-white shadow-sm bg-gray-100"
                    x-data="{ name: '{{ $history['name'] }}' }"
                    x-html="avatarHTML(name)"
                ></div>
                <div class="flex-1 pb-4 border-b border-gray-50">
                    <div class="flex justify-between items-start">
                        @if ($history['action'] == 'CREATE')
                            <div>
                                <p class="text-sm text-gray-800">
                                    <span class="font-bold text-gray-900">{{ $history['name'] }}</span> menambahkan <span class="font-semibold">{{ $history['modelType'] }}</span> baru.
                                </p>
                                <p class="text-sm font-bold text-[#3e77f4] mt-1 bg-blue-50 inline-block px-2 py-0.5 rounded">{{ $history['changes']['after']['name'].' - '.$history['changes']['after']['code'] }} </p>
                            </div>
                        @endif
                        <span class="text-xs font-medium text-gray-400 whitespace-nowrap">{{ $history['createdAt'] }}</span>
                    </div>
                </div>
            </div>
        @endforeach    
    </div>
    
    @if (boolval($hasMore))
        <div class="mt-6 text-center">
            <button 
                wire:click="loadMore" 
                wire:loading.attr="disabled"
                wire:target="loadMore"
                class="text-sm font-bold text-[#3e77f4] hover:text-[#3669d9] transition-colors cursor-pointer"
            >
                <span wire:loading.remove wire:target="loadMore">Lihat lebih banyak ↓</span>
                <span wire:loading wire:target="loadMore">Loading...</span>
            </button>
        </div>
    @endif
</x-card>