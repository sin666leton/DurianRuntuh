<aside class="flex flex-col h-screen sticky top-0 bg-white *:px-4 shadow-md">
    <div class="bg-[#3e77f4] flex items-center min-h-16 max-h-16 px-6">
        <img src="{{ asset('assets/images/logo.png') }}" class="h-10 w-auto" alt="Logo">
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
            <p>Master Tipe</p>
        </a>
    </div>
</aside>