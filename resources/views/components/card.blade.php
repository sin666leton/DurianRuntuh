<div class="flex flex-col bg-white p-4 rounded-md shadow-sm gap-4">
    <!-- Header card -->
    @if (!empty($title))
        <div>
            <h4>{{ $title }}</h4>
        </div>
    @endif
    <div>
        {{ $slot }}
    </div>
</div>