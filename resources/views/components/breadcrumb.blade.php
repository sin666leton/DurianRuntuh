<nav class="flex text-sm text-gray-500">
    @foreach($links as $label => $url)
        @if(!$loop->last)
            <a href="{{ $url }}" wire:navigate class="hover:text-blue-500">{{ $label }}</a>
            <span class="mx-2">></span>
        @else
            <span class="text-gray-800">{{ $label }}</span>
        @endif
    @endforeach
</nav>