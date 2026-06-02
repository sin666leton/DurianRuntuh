<aside class="flex flex-col h-screen sticky top-0 bg-white *:px-4 shadow-md">
    <div class="bg-[#3e77f4] flex items-center min-h-16 max-h-16 px-6">
        Logo
    </div>
    <div class="flex-1 py-8 space-y-2 *:cursor-pointer *:duration-100 *:px-4 *:py-3 *:rounded-md *:block">
        <a href="/home" wire:navigate wire:current="hover:bg-transparent text-[#3e77f4] font-semibold" class="hover:bg-[#ededed]">
            <p>Beranda</p>
        </a>
        <a href="/brands" wire:navigate wire:current="hover:bg-transparent text-[#3e77f4] font-semibold" class="hover:bg-[#ededed]">
            <p>Master Merk</p>
        </a>
        <a href="/type-items" wire:navigate wire:current="hover:bg-transparent text-[#3e77f4] font-semibold" class="hover:bg-[#ededed]">
            <p>Master Jenis Barang</p>
        </a>
        <a href="/types" wire:navigate wire:current="hover:bg-transparent text-[#3e77f4] font-semibold" class="hover:bg-[#ededed]">
            <p>Master Tipe & Items</p>
        </a>
    </div>
    <div class="border-t-2 border-gray-100 py-2">
        <div class="flex items-center gap-3">
            <!-- Profile picture -->
            <div class="w-12">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                    <path fill="rgb(0, 0, 0)" d="M463 448.2C440.9 409.8 399.4 384 352 384L288 384C240.6 384 199.1 409.8 177 448.2C212.2 487.4 263.2 512 320 512C376.8 512 427.8 487.3 463 448.2zM64 320C64 178.6 178.6 64 320 64C461.4 64 576 178.6 576 320C576 461.4 461.4 576 320 576C178.6 576 64 461.4 64 320zM320 336C359.8 336 392 303.8 392 264C392 224.2 359.8 192 320 192C280.2 192 248 224.2 248 264C248 303.8 280.2 336 320 336z"/>
                </svg>
            </div>
            <div class="flex-1 flex flex-col justify-center -space-y-1">
                <!-- Name -->
                <h3 class="text-lg font-semibold">{{ $name }}</h3>
                <!-- Username -->
                <h4 class="text-gray-500">#{{ $username }}</h4>
            </div>
            <!-- Logout -->
            <div class="p-3 w-13 flex items-center justify-center cursor-pointer" wire:click="logout">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                    <path fill="rgb(0, 0, 0)" d="M569 337C578.4 327.6 578.4 312.4 569 303.1L425 159C418.1 152.1 407.8 150.1 398.8 153.8C389.8 157.5 384 166.3 384 176L384 256L272 256C245.5 256 224 277.5 224 304L224 336C224 362.5 245.5 384 272 384L384 384L384 464C384 473.7 389.8 482.5 398.8 486.2C407.8 489.9 418.1 487.9 425 481L569 337zM224 160C241.7 160 256 145.7 256 128C256 110.3 241.7 96 224 96L160 96C107 96 64 139 64 192L64 448C64 501 107 544 160 544L224 544C241.7 544 256 529.7 256 512C256 494.3 241.7 480 224 480L160 480C142.3 480 128 465.7 128 448L128 192C128 174.3 142.3 160 160 160L224 160z"/>
                </svg>
            </div>
        </div>
    </div>
</aside>