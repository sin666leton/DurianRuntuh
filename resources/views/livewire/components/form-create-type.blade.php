<div class="space-y-4">
    @if(filled($errorMessage))
        <div class="bg-red-400 text-white rounded-sm border-2 border-red-500 px-4 py-2 font-bold">
            {{ $errorMessage }}
        </div>
    @endif
    <x-card title="Tambah Tipe">
        <form wire:submit="submit">
            <div class="flex flex-col gap-2">
                <!-- Brand -->
                <x-search-select
                    wire:click="getBrand"
                    wire:model.live.debounce.300ms="searchBrand"
                    type="text"
                    label="Pilih Merk"
                    msg="{{ $errors->has('selectedBrandId') ? '* '.$errors->first('selectedBrandId') : '' }}"
                    required

                    selected-name="{{ $selectedBrandName }}"
                    is-open="{{ $brandOpen }}"

                    clear-action="clearBrand"
                    close-dropdown-action="closeBrandDropdown"
                >
                    @forelse($brandItems as $eachBrand)
                        <li wire:click="selectBrand({{ $eachBrand['id'] }}, '{{ $eachBrand['name'] }}', '{{ $eachBrand['code'] }}')" class="px-4 py-2 cursor-pointer hover:bg-blue-50 hover:text-blue-700 {{ $selectedBrandId === $eachBrand['code'] ? 'bg-blue-100 font-semibold text-blue-700' : 'text-gray-700' }}">
                            {{ $eachBrand['name'].' - '.$eachBrand['code'] }}
                        </li>
                    @empty
                        <li class="px-4 py-2 text-gray-400 italic">Tidak ada hasil</li>
                    @endforelse
                </x-search-select>
                
                <!-- Type Item -->
                <x-search-select
                    wire:click="getTypeItem"
                    wire:model.live.debounce.300ms="searchTypeItem"
                    type="text"
                    label="Pilih Jenis Barang"
                    msg="{{ $errors->has('selectedTypeItemId') ? '* '.$errors->first('selectedTypeItemId') : '' }}"
                    required
                    x-bind:class="$wire.selectedBrandId ? 'bg-white' : 'bg-[#efefef]'"
                    :disabled="!filled($selectedBrandId)"

                    selected-name="{{ $selectedTypeItemName }}"
                    is-open="{{ $typeItemOpen }}"

                    clear-action="clearTypeItem"
                    close-dropdown-action="closeTypeItemDropdown"
                >
                    @forelse($typeItemItems as $eachTypeItem)
                        <li wire:click="selectTypeItem({{ $eachTypeItem['id'] }}, '{{ $eachTypeItem['name'] }}', '{{ $eachTypeItem['code'] }}')" class="px-4 py-2 cursor-pointer hover:bg-blue-50 hover:text-blue-700 {{ $selectedTypeItemId === $eachTypeItem['code'] ? 'bg-blue-100 font-semibold text-blue-700' : 'text-gray-700' }}">
                            {{ $eachTypeItem['name'].' - '.$eachTypeItem['code'] }}
                        </li>
                    @empty
                        <li class="px-4 py-2 text-gray-400 italic">Tidak ada hasil</li>
                    @endforelse
                </x-search-select>

                <x-input
                    wire:model="name"
                    type="text"
                    label="Nama"
                    msg="{{ $errors->has('name') ? '* '.$errors->first('name') : '' }}"
                    required
                    x-bind:class="!$wire.selectedTypeItemId || !$wire.selectedBrandId ? 'bg-[#efefef]' : 'bg-white'"
                    :disabled="!filled($selectedTypeItemId) || !filled($selectedBrandId)"
                />

                <x-input
                    x-bind:class=" $wire.autoGenerate === '1' || !$wire.selectedBrandId || !$wire.selectedTypeItemId ? 'bg-[#efefef]' : 'bg-white'"
                    wire:model="code"
                    type="text"
                    label="Kode"
                    msg="{{ $errors->has('code') ? '* '.$errors->first('code') : '' }}"
                    x-bind:disabled="$wire.autoGenerate === '1' || !$wire.selectedBrandId || !$wire.selectedTypeItemId"
                />

                <x-checkbox
                    wire:model.live="autoGenerate"
                    wire:loading.attr="disabled"
                    wire:target="autoGenerate"
                    label="Auto generate"
                    checked
                    :disabled="!filled($selectedTypeItemId) || !filled($selectedBrandId)"
                />

                <div class="flex justify-end mt-3">
                    <x-primary-button type="submit" text="Submit"/>
                </div>
            </div>
        </form>
    </x-card>
</div>