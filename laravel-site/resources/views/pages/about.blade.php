@extends('layouts.app')

@section('title', 'About')
@section('meta_description', 'Learn about our car parts shop and how we work.')

@section('content')
    <x-container class="py-10 sm:py-14">
        <div class="max-w-2xl">
            <h1 class="text-3xl font-semibold tracking-tight sm:text-4xl">
                About {{ config('site.name') }}
            </h1>
            <p class="mt-4 text-zinc-600">
                We help drivers and mechanics find the right parts — quickly and at a fair price.
                Whether you’re doing routine maintenance or a full repair, we’ll guide you to the best option.
            </p>

            <div class="mt-8 grid gap-4 sm:grid-cols-2">
                <div class="rounded-2xl border border-zinc-200 bg-white p-5">
                    <div class="text-sm font-semibold">Compatibility first</div>
                    <p class="mt-2 text-sm text-zinc-600">We double-check fitment details before confirming a quote.</p>
                </div>
                <div class="rounded-2xl border border-zinc-200 bg-white p-5">
                    <div class="text-sm font-semibold">OEM & aftermarket</div>
                    <p class="mt-2 text-sm text-zinc-600">We offer choices, explain trade-offs, and let you decide.</p>
                </div>
                <div class="rounded-2xl border border-zinc-200 bg-white p-5">
                    <div class="text-sm font-semibold">Clear communication</div>
                    <p class="mt-2 text-sm text-zinc-600">Pricing, availability, and timelines shared up front.</p>
                </div>
                <div class="rounded-2xl border border-zinc-200 bg-white p-5">
                    <div class="text-sm font-semibold">Fast replies on Facebook</div>
                    <p class="mt-2 text-sm text-zinc-600">Great for photos, part numbers, and quick Q&A.</p>
                </div>
            </div>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                <x-button :href="url('/contact')">Request a quote</x-button>
                <x-button :href="config('site.facebook_url')" external variant="secondary">Visit Facebook</x-button>
            </div>
        </div>
    </x-container>
@endsection

