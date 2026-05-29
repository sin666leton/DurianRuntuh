<div class="flex gap-2">
    <input
        type="checkbox"
        {{ $attributes }}
        id="{{ $label }}"
        class="border border-gray-300"
    />
    <label for="{{ $label }}">{{ $label }}</label>
</div>