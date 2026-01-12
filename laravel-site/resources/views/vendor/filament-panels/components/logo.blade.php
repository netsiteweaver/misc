@php
    $brandName = filament()->getBrandName();
    $brandLogo = filament()->getBrandLogo();
    $brandLogoHeight = filament()->getBrandLogoHeight() ?? '1.5rem';
    $darkModeBrandLogo = filament()->getDarkModeBrandLogo();
    $hasDarkModeBrandLogo = filled($darkModeBrandLogo);

    $getLogoClasses = fn (bool $isDarkMode): string => \Illuminate\Support\Arr::toCssClasses([
        'fi-logo',
        'flex' => ! $hasDarkModeBrandLogo,
        'flex dark:hidden' => $hasDarkModeBrandLogo && (! $isDarkMode),
        'hidden dark:flex' => $hasDarkModeBrandLogo && $isDarkMode,
    ]);

    $logoStyles = "height: {$brandLogoHeight}";
@endphp

@capture($content, $logo, $isDarkMode = false)
    @if ($logo instanceof \Illuminate\Contracts\Support\Htmlable)
        <div
            {{
                $attributes
                    ->class([$getLogoClasses($isDarkMode), 'flex items-center gap-3'])
            }}
        >
            <div style="{{ $logoStyles }}">{{ $logo }}</div>
            @if (filled($brandName))
                <div class="text-xl font-bold leading-5 tracking-tight text-gray-950 dark:text-white">
                    {{ $brandName }}
                </div>
            @endif
        </div>
    @elseif (filled($logo))
        <div
            {{
                $attributes
                    ->class([$getLogoClasses($isDarkMode), 'flex items-center gap-3'])
            }}
        >
            <img
                alt="{{ __('filament-panels::layout.logo.alt', ['name' => $brandName]) }}"
                src="{{ $logo }}"
                style="{{ $logoStyles }}"
            />
            @if (filled($brandName))
                <div class="text-xl font-bold leading-5 tracking-tight text-gray-950 dark:text-white">
                    {{ $brandName }}
                </div>
            @endif
        </div>
    @else
        <div
            {{
                $attributes->class([
                    $getLogoClasses($isDarkMode),
                    'text-xl font-bold leading-5 tracking-tight text-gray-950 dark:text-white',
                ])
            }}
        >
            {{ $brandName }}
        </div>
    @endif
@endcapture

{{ $content($brandLogo) }}

@if ($hasDarkModeBrandLogo)
    {{ $content($darkModeBrandLogo, isDarkMode: true) }}
@endif
