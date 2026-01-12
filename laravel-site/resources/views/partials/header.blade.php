@php
    $nav = [
        ['href' => url('/'), 'label' => 'Home'],
        ['href' => url('/catalog'), 'label' => 'Catalog'],
        ['href' => url('/about'), 'label' => 'About'],
        ['href' => url('/contact'), 'label' => 'Contact'],
    ];
    
    $settings = \App\Models\SiteSettings::getSettings();
    $logoUrl = $settings->logo_path ? asset('storage/' . $settings->logo_path) : null;
@endphp

<header class="sticky top-0 z-50 border-b border-zinc-200/70 bg-white/80 backdrop-blur">
    <div class="hidden border-b border-zinc-200 bg-zinc-950 text-white sm:block">
        <x-container class="flex h-10 items-center justify-between text-xs">
            <div class="flex items-center gap-4">
                <span class="inline-flex items-center gap-2">
                    <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                    Quote fast on Facebook
                </span>
                <span class="text-white/70">Send car model/year + part name (or photo)</span>
            </div>
            <div class="flex items-center gap-4 text-white/80">
                @if (filled(config('site.phone')))
                    <span>Call: {{ config('site.phone') }}</span>
                @endif
                @if (filled(config('site.hours')))
                    <span>Hours: {{ config('site.hours') }}</span>
                @endif
            </div>
        </x-container>
    </div>

    <x-container class="flex h-16 items-center justify-between gap-4">
        <a href="{{ url('/') }}" class="flex items-center gap-3 font-semibold">
            @if($logoUrl)
                <img
                    src="{{ $logoUrl }}"
                    alt="{{ $settings->name }}"
                    class="h-[100px] w-auto rounded-xl object-cover"
                />
            @else
                <span class="inline-flex h-[100px] w-[100px] items-center justify-center rounded-xl bg-zinc-900 text-white">
                    <span class="text-sm">CP</span>
                </span>
            @endif
            <div class="leading-tight">
                <div class="text-sm sm:text-base">{{ $settings->name ?? config('site.name') }}</div>
                <div class="hidden text-xs font-normal text-zinc-500 sm:block">
                    Car parts · Retail &amp; wholesale
                </div>
            </div>
        </a>

        <nav class="hidden items-center gap-7 sm:flex">
            @foreach ($nav as $item)
                <a href="{{ $item['href'] }}" class="text-sm font-medium text-zinc-700 hover:text-zinc-900">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="flex items-center gap-3">
            <a
                href="{{ config('site.facebook_url') }}"
                target="_blank"
                rel="noopener noreferrer"
                class="hidden rounded-full bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700 sm:inline-flex"
            >
                Message on Facebook
            </a>

            <details class="relative sm:hidden">
                <summary class="list-none rounded-full border border-zinc-200 bg-white px-4 py-2 text-sm font-semibold text-zinc-900">
                    Menu
                </summary>
                <div class="absolute right-0 mt-2 w-56 overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-lg">
                    <div class="p-2">
                        @foreach ($nav as $item)
                            <a href="{{ $item['href'] }}" class="block rounded-xl px-3 py-2 text-sm font-medium text-zinc-800 hover:bg-zinc-50">
                                {{ $item['label'] }}
                            </a>
                        @endforeach
                        <a
                            href="{{ config('site.facebook_url') }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="mt-1 block rounded-xl bg-red-600 px-3 py-2 text-sm font-semibold text-white hover:bg-red-700"
                        >
                            Facebook
                        </a>
                    </div>
                </div>
            </details>
        </div>
    </x-container>
</header>

