<div class="flex flex-col gap-3">
    <div class="flex flex-row justify-start gap-6">
        <!-- Fitur cari -->
        <div class="flex bg-white rounded-full items-center shadow-sm">
            <div class="pl-4 pr-1">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                    <path fill="rgb(180, 180, 180)" d="M480 272C480 317.9 465.1 360.3 440 394.7L566.6 521.4C579.1 533.9 579.1 554.2 566.6 566.7C554.1 579.2 533.8 579.2 521.3 566.7L394.7 440C360.3 465.1 317.9 480 272 480C157.1 480 64 386.9 64 272C64 157.1 157.1 64 272 64C386.9 64 480 157.1 480 272zM272 416C351.5 416 416 351.5 416 272C416 192.5 351.5 128 272 128C192.5 128 128 192.5 128 272C128 351.5 192.5 416 272 416z"/>
                </svg>
            </div>
            <div class="flex-1">
                <input
                    wire:model.live.debounce.300ms="searchTypeItem"
                    type="text"
                    name=""
                    id=""
                    placeholder="Cari"
                    class="px-2 py-2 w-full focus:outline-none"
                />
            </div>
        </div>
        <div class="flex">
            <!-- Fitur tampilkan data -->
            <div class="flex gap-2 items-center">
                <span class="text-sm font-semibold">Tampilkan</span>
                <div class="flex-1" class="">
                    <select
                        wire:model.live="size"
                        name=""
                        id=""
                        class="bg-white px-1.5 py-1 rounded-sm shadow-sm text-sm"
                    >
                        <option value="10">10</option>
                        <option value="20">2</option>
                        <option value="30">30</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col bg-white rounded-md shadow-sm min-w-full max-h-96 overflow-hidden">
        <div class="flex-1 overflow-x-auto">
            <table class="table-fixed w-full text-left">
                <thead class="sticky top-0 shadow-sm shadow-gray-200 bg-white ">
                    <tr class="*:px-4 *:py-2 *:text-gray-500 *:font-normal *:text-sm *:sticky *:top-0">
                        <th class="w-36">Nama</th>
                        <th class="w-16">Kode</th>
                        <th class="w-52">Pembuat</th>
                    </tr>
                </thead>
                <tbody class="overflow-y-auto w-full *:border-b *:border-gray-200">
                    @foreach ($pagination->items() as $item)
                        <tr class="*:px-4 *:py-2">
                            <td class="font-semibold">{{ $item->name }}</td>
                            <td>{{ $item->code }}</td>
                            <td class="flex flex-col">
                                <span class="text-sm font-bold">{{ $item->userName }}</span>
                                <span class="text-sm text-gray-500">#{{ $item->username }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="border-t border-gray-200 py-2 px-4">
            {{ $pagination->links('vendor.livewire.bootstrap') }}
        </div>
    </div>
</div>