@php
if (! isset($scrollTo)) {
    $scrollTo = 'body';
}

$scrollIntoViewJsSnippet = ($scrollTo !== false)
    ? <<<JS
       (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
    JS
    : '';
@endphp

<div>
    @if ($paginator->hasPages())
        <nav class="d-flex justify-items-center justify-content-between">
            <ul class="flex items-center justify-center">
                <div class="">
                    {{-- << Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="text-xl">&lsaquo;&lsaquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <button
                                type="button"
                                dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                                class="text-xl cursor-pointer"
                                wire:click="previousPage('{{ $paginator->getPageName() }}')"
                                x-on:click="{{ $scrollIntoViewJsSnippet }}"
                                wire:loading.attr="disabled"
                            >
                                &lsaquo;&lsaquo;
                            </button>
                        </li>
                    @endif
                </div>

                <div class="flex items-center justify-center gap-0.5 w-full">
                    <div class="mr-2">
                        {{-- < Previous Page Link --}}
                        @if ($paginator->onFirstPage())
                            <li class="text-gray-500 px-2" aria-disabled="true" aria-label="@lang('pagination.previous')">
                                <span class="text-xl" aria-hidden="true">&lsaquo;</span>
                            </li>
                        @else
                            <li>
                                <button
                                    type="button"
                                    dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                                    class="px-2 cursor-pointer font-semibold text-xl"
                                    wire:click="previousPage('{{ $paginator->getPageName() }}')"
                                    x-on:click="{{ $scrollIntoViewJsSnippet }}"
                                    wire:loading.attr="disabled"
                                    aria-label="@lang('pagination.previous')"
                                >
                                    &lsaquo;
                                </button>
                            </li>
                        @endif
                    </div>

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item disabled" aria-disabled="true">
                                <span class="page-link">
                                    {{ $element }}
    
                                </span></li>
                        @endif
                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="font-bold text-[#3e77f4] cursor-pointer px-1.5" wire:key="paginator-{{ $paginator->getPageName() }}-page-{{ $page }}" aria-current="page">
                                        <span class="page-link">
                                            {{ $page }}
                                        </span>
                                    </li>
                                @else
                                    <li class="cursor-pointer" wire:key="paginator-{{ $paginator->getPageName() }}-page-{{ $page }}">
                                        <button type="button" class="text-gray-500 cursor-pointer px-1.5" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}">
                                            {{ $page }}
                                        </button>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    <div class="ml-2">
                        {{-- Next Page Link > --}}
                        @if ($paginator->hasMorePages())
                            <li>
                                <button
                                    type="button"
                                    dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                                    class="px-2 cursor-pointer font-semibold text-xl"
                                    wire:click="nextPage('{{ $paginator->getPageName() }}')"
                                    x-on:click="{{ $scrollIntoViewJsSnippet }}"
                                    wire:loading.attr="disabled"
                                    aria-label="@lang('pagination.next')"
                                >
                                    &rsaquo;
                                </button>
                            </li>
                        @else
                            <li aria-disabled="true" aria-label="@lang('pagination.next')">
                                <span class="text-gray-500 px-2 text-xl" aria-hidden="true">&rsaquo;</span>
                            </li>
                        @endif
                    </div>
                </div>
                {{-- Next Page Link >> --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <button
                            type="button"
                            dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                            class="px-2 text-xl cursor-pointer"
                            wire:click="nextPage('{{ $paginator->getPageName() }}')"
                            x-on:click="{{ $scrollIntoViewJsSnippet }}"
                            wire:loading.attr="disabled"
                        >
                            &rsaquo;&rsaquo;
                        </button>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="text-gray-500 text-xl" aria-hidden="true">&rsaquo;&rsaquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
    @endif
</div>
