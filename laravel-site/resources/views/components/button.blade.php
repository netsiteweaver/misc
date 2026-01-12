@props([
    'href' => '#',
    'variant' => 'primary', // primary | secondary
    'external' => false,
])

@php
    $base = 'inline-flex items-center justify-center rounded-full px-5 py-2.5 text-sm font-semibold transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-zinc-900/30';
    $styles = $variant === 'primary'
        ? 'bg-red-600 text-white hover:bg-red-700'
        : 'bg-white text-zinc-900 ring-1 ring-zinc-200 hover:bg-zinc-50';
@endphp

<a
    href="{{ $href }}"
    @if($external) target="_blank" rel="noopener noreferrer" @endif
    {{ $attributes->merge(['class' => $base.' '.$styles]) }}
>
    {{ $slot }}
</a>

