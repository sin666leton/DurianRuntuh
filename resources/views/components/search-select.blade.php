@props([
    'isOpen' => false,
    'selectedName',
    'clearAction',
    'closeDropdownAction'
])

<div class="relative w-full max-w-sm" wire:click.outside="{{ $closeDropdownAction }}">
    <div class="relative">
        <x-input
            {{ $attributes }}
        />
        @if(filled($selectedName))
            <button type="button" wire:click="{{$clearAction}}"
                class="absolute right-3 top-1/2 text-gray-400 hover:text-red-500">
                &times;
            </button>
        @else
            <span class="absolute right-3 top-1/2 text-gray-400 pointer-events-none">▾</span>
        @endif
    </div>
    @if($isOpen)
        <ul class="absolute z-50 mt-1 w-full bg-white border border-gray-200 rounded-lg shadow-lg max-h-52 overflow-y-auto text-sm">
            {{ $slot }}
        </ul>
    @endif
</div>