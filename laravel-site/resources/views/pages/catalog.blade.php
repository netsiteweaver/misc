@extends('layouts.app')

@section('title', 'Catalog')
@section('meta_description', 'Browse car parts categories and request a quote.')

@section('content')
    @php
        $categories = config('catalog.categories');
    @endphp

    <x-container class="py-10 sm:py-14">
        <div class="max-w-2xl">
            <h1 class="text-3xl font-semibold tracking-tight sm:text-4xl">Catalog</h1>
            <p class="mt-3 text-zinc-600">
                Use these categories to describe what you need. For the fastest quote,
                send your car model/year and a photo of the old part if possible.
            </p>
            <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                <x-button :href="url('/contact')">Request a quote</x-button>
                <x-button :href="config('site.facebook_url')" external variant="secondary">Message on Facebook</x-button>
            </div>
        </div>

        <div class="mt-10 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($categories as $c)
                <div class="rounded-2xl border border-zinc-200 bg-white p-5">
                    <div class="text-base font-semibold">{{ $c['title'] }}</div>
                    <p class="mt-2 text-sm text-zinc-600">{{ $c['description'] }}</p>
                    <ul class="mt-4 space-y-1 text-sm text-zinc-700">
                        @foreach ($c['examples'] as $e)
                            <li class="flex gap-2">
                                <span class="mt-2 h-1.5 w-1.5 shrink-0 rounded-full bg-zinc-400"></span>
                                <span>{{ $e }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </x-container>
@endsection

