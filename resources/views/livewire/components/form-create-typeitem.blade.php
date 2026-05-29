<div class="space-y-4">
    @if(filled($errorMessage))
        <div class="bg-red-400 text-white rounded-sm border-2 border-red-500 px-4 py-2 font-bold">
            {{ $errorMessage }}
        </div>
    @endif
    <x-card title="Tambah Jenis barang">
        <form wire:submit="submit">
            <div class="flex flex-col gap-2">
                <x-input
                    wire:model="name"
                    type="text"
                    label="Nama"
                    msg="{{ $errors->has('name') ? '* '.$errors->first('name') : '' }}"
                    required
                />
                <x-input
                    x-bind:class="$wire.autoGenerate === '1' ? 'bg-[#efefef]' : 'bg-white'"
                    wire:model="code"
                    type="text"
                    label="Kode"
                    msg="{{ $errors->has('code') ? '* '.$errors->first('code') : '' }}"
                    x-bind:disabled="$wire.autoGenerate === '1'"
                />
                <x-checkbox
                    wire:model.live="autoGenerate"
                    wire:loading.attr="disabled"
                    wire:target="autoGenerate"
                    label="Auto generate"
                    checked
                />
                <div class="flex justify-end mt-3">
                    <x-primary-button type="submit" text="Submit"/>
                </div>
            </div>
        </form>
    </x-card>
</div>