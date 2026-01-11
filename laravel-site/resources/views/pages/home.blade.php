@extends('layouts.app')

@section('meta_description', config('site.tagline'))

@section('content')
    @php
        $categories = config('catalog.categories');
        $featured = config('catalog.featured_products');
        $brands = config('catalog.brands');
    @endphp

    <section class="relative overflow-hidden">
        <div class="absolute inset-0 -z-10 bg-[radial-gradient(ellipse_at_top,rgba(220,38,38,0.14),transparent_55%)]"></div>

        <x-container class="py-12 sm:py-18">
            <div class="grid gap-10 lg:grid-cols-2 lg:items-center">
                <div class="max-w-xl">
                    <div class="inline-flex items-center gap-2 rounded-full bg-zinc-100 px-3 py-1 text-xs font-semibold text-zinc-700">
                        Automotive parts · Retail & wholesale
                    </div>
                    <h1 class="mt-5 text-4xl font-semibold tracking-tight text-zinc-900 sm:text-5xl">
                        {{ config('site.name') }}
                    </h1>
                    <p class="mt-4 text-lg leading-8 text-zinc-600">
                        {{ config('site.tagline') }}
                        Tell us your car model + part name (or send a photo), and we’ll confirm availability and price.
                    </p>

                    <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center">
                        <x-button :href="url('/catalog')">Shop categories</x-button>
                        <x-button :href="url('/contact')" variant="secondary">Request a quote</x-button>
                        <x-button :href="config('site.facebook_url')" external variant="secondary">Visit Facebook</x-button>
                    </div>

                    <div class="mt-10 grid gap-4 sm:grid-cols-3">
                        <div class="rounded-2xl border border-zinc-200 bg-white p-4">
                            <div class="text-sm font-semibold">Fast sourcing</div>
                            <div class="mt-1 text-sm text-zinc-600">OEM and quality aftermarket options.</div>
                        </div>
                        <div class="rounded-2xl border border-zinc-200 bg-white p-4">
                            <div class="text-sm font-semibold">Right fit</div>
                            <div class="mt-1 text-sm text-zinc-600">We verify compatibility before you buy.</div>
                        </div>
                        <div class="rounded-2xl border border-zinc-200 bg-white p-4">
                            <div class="text-sm font-semibold">Support</div>
                            <div class="mt-1 text-sm text-zinc-600">Friendly guidance for repairs and upgrades.</div>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="rounded-3xl border border-zinc-200 bg-white p-6 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div class="text-sm font-semibold">Quick quote checklist</div>
                            <span class="rounded-full bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-700">Fast</span>
                        </div>
                        <div class="mt-4 grid gap-3">
                            <div class="rounded-2xl bg-zinc-50 p-4">
                                <div class="text-xs font-semibold text-zinc-700">1) Vehicle</div>
                                <div class="mt-1 text-sm text-zinc-600">Make, model, year (engine optional)</div>
                            </div>
                            <div class="rounded-2xl bg-zinc-50 p-4">
                                <div class="text-xs font-semibold text-zinc-700">2) Part</div>
                                <div class="mt-1 text-sm text-zinc-600">Name, side (L/R), qty</div>
                            </div>
                            <div class="rounded-2xl bg-zinc-50 p-4">
                                <div class="text-xs font-semibold text-zinc-700">3) Photo</div>
                                <div class="mt-1 text-sm text-zinc-600">Old part / part number label</div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <a
                                href="{{ config('site.facebook_url') }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex w-full items-center justify-center rounded-2xl bg-zinc-950 px-4 py-3 text-sm font-semibold text-white hover:bg-zinc-900"
                            >
                                Start on Facebook
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </x-container>
    </section>

    <section class="border-t border-zinc-200 bg-zinc-50/60">
        <x-container class="py-12">
            <div class="flex items-end justify-between gap-6">
                <div>
                    <h2 class="text-2xl font-semibold tracking-tight">Shop by category</h2>
                    <p class="mt-2 text-sm text-zinc-600">
                        Choose a category to describe what you need — we’ll do the rest.
                    </p>
                </div>
                <div class="hidden sm:block">
                    <x-button :href="url('/catalog')" variant="secondary">View all</x-button>
                </div>
            </div>

            <div class="mt-8 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($categories as $c)
                    <a
                        href="{{ url('/catalog') }}"
                        class="group rounded-2xl border border-zinc-200 bg-white p-5 transition-colors hover:border-zinc-300"
                    >
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <div class="text-base font-semibold">{{ $c['title'] }}</div>
                                <div class="mt-2 text-sm text-zinc-600">{{ $c['description'] }}</div>
                            </div>
                            <span class="mt-1 inline-flex h-9 w-9 items-center justify-center rounded-xl bg-red-50 text-red-700 group-hover:bg-red-100">
                                →
                            </span>
                        </div>
                        <div class="mt-3 flex flex-wrap gap-2">
                            @foreach (array_slice($c['examples'], 0, 3) as $e)
                                <span class="rounded-full bg-zinc-100 px-2.5 py-1 text-xs font-medium text-zinc-700">
                                    {{ $e }}
                                </span>
                            @endforeach
                        </div>
                    </a>
                @endforeach
            </div>
        </x-container>
    </section>

    <section class="border-t border-zinc-200 bg-white">
        <x-container class="py-12">
            <div class="flex items-end justify-between gap-6">
                <div>
                    <h2 class="text-2xl font-semibold tracking-tight">Featured items</h2>
                    <p class="mt-2 text-sm text-zinc-600">Popular requests — pricing depends on vehicle and brand.</p>
                </div>
                <div class="hidden sm:block">
                    <x-button :href="url('/contact')" variant="secondary">Get a quote</x-button>
                </div>
            </div>

            <div class="mt-8 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($featured as $p)
                    <div class="overflow-hidden rounded-2xl border border-zinc-200 bg-white">
                        <div class="h-36 bg-[linear-gradient(135deg,rgba(220,38,38,0.14),rgba(24,24,27,0.06))]"></div>
                        <div class="p-5">
                            <div class="text-base font-semibold">{{ $p['name'] }}</div>
                            <div class="mt-1 text-sm text-zinc-600">{{ $p['note'] }}</div>
                            <div class="mt-4 flex items-center justify-between">
                                <div class="text-sm font-semibold text-zinc-900">{{ $p['price_from'] }}</div>
                                <a href="{{ url('/contact') }}" class="text-sm font-semibold text-red-700 hover:text-red-800">
                                    Request →
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-container>
    </section>

    <section class="border-t border-zinc-200 bg-zinc-950 text-white">
        <x-container class="py-12">
            <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="text-2xl font-semibold tracking-tight">We stock & source trusted brands</h2>
                    <p class="mt-2 text-sm text-white/70">
                        Ask for OEM, economy, or premium — we’ll offer options.
                    </p>
                </div>
                <a
                    href="{{ config('site.facebook_url') }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center justify-center rounded-full bg-white px-5 py-2.5 text-sm font-semibold text-zinc-900 hover:bg-zinc-100"
                >
                    Message us
                </a>
            </div>

            <div class="mt-8 grid grid-cols-2 gap-3 sm:grid-cols-4 lg:grid-cols-8">
                @foreach ($brands as $b)
                    <div class="rounded-2xl border border-white/10 bg-white/5 px-3 py-3 text-center text-xs font-semibold text-white/90">
                        {{ $b }}
                    </div>
                @endforeach
            </div>
        </x-container>
    </section>
@endsection

