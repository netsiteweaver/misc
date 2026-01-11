@extends('layouts.app')

@section('title', 'Contact')
@section('meta_description', 'Request a quote for car parts via Facebook or email.')

@section('content')
    @php
        $message = implode("\n", [
            "Hi! I’d like a quote for a car part.",
            "",
            "Car: (make/model/year)",
            "Engine: (optional)",
            "Part needed: (name)",
            "Qty: (1)",
            "Any photo of old part: (attach)",
            "",
            "Thank you.",
        ]);

        $mailto = filled(config('site.email'))
            ? 'mailto:'.rawurlencode(config('site.email'))
                .'?subject='.rawurlencode('Car parts quote request')
                .'&body='.rawurlencode($message)
            : null;
    @endphp

    <x-container class="py-10 sm:py-14">
        <div class="max-w-2xl">
            <h1 class="text-3xl font-semibold tracking-tight sm:text-4xl">Contact</h1>
            <p class="mt-3 text-zinc-600">
                The fastest way to get a quote is to message us on Facebook with your car details and a photo of the old part.
            </p>

            <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                <x-button :href="config('site.facebook_url')" external>Message us on Facebook</x-button>

                @if ($mailto)
                    <x-button :href="$mailto" external variant="secondary">Email request</x-button>
                @else
                    <x-button :href="config('site.facebook_url')" external variant="secondary">(Add email later)</x-button>
                @endif
            </div>

            <div class="mt-10 rounded-2xl border border-zinc-200 bg-white p-5">
                <div class="text-sm font-semibold">What to send (copy/paste)</div>
                <pre class="mt-3 whitespace-pre-wrap rounded-xl bg-zinc-50 p-4 text-sm text-zinc-700">{{ $message }}</pre>
                <p class="mt-3 text-xs text-zinc-500">Tip: Photos of the part number label help a lot.</p>
            </div>
        </div>
    </x-container>
@endsection

