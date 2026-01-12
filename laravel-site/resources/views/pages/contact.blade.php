@extends('layouts.app')

@section('title', 'Contact')
@section('meta_description', 'Request a quote for car parts via Facebook or email.')

@section('content')
    @php
        $mailto = filled(config('site.email'))
            ? 'mailto:'.rawurlencode(config('site.email'))
                .'?subject='.rawurlencode('Car parts quote request')
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

            @if (session('success'))
                <div class="mt-8 rounded-2xl border border-green-200 bg-green-50 p-4 text-sm text-green-900">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mt-10 rounded-2xl border border-zinc-200 bg-white p-5">
                <div class="text-sm font-semibold">Request a quote (website form)</div>
                <p class="mt-2 text-sm text-zinc-600">
                    Submitting this form will create a request in our back office. For photos, Facebook is still the fastest.
                </p>

                <form method="POST" action="{{ route('quote-requests.store') }}" class="mt-6 grid gap-4 sm:grid-cols-2">
                    @csrf

                    <div class="sm:col-span-2">
                        <label class="text-sm font-semibold">Part needed *</label>
                        <input
                            name="part_name"
                            value="{{ old('part_name') }}"
                            required
                            class="mt-2 w-full rounded-xl border border-zinc-200 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-200"
                            placeholder="e.g. Brake pads front"
                        />
                        @error('part_name') <div class="mt-1 text-xs text-red-600">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Car make</label>
                        <input name="vehicle_make" value="{{ old('vehicle_make') }}" class="mt-2 w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-200" placeholder="e.g. Toyota" />
                    </div>
                    <div>
                        <label class="text-sm font-semibold">Car model</label>
                        <input name="vehicle_model" value="{{ old('vehicle_model') }}" class="mt-2 w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-200" placeholder="e.g. Corolla" />
                    </div>
                    <div>
                        <label class="text-sm font-semibold">Year</label>
                        <input name="vehicle_year" value="{{ old('vehicle_year') }}" class="mt-2 w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-200" placeholder="e.g. 2014" />
                    </div>
                    <div>
                        <label class="text-sm font-semibold">Engine (optional)</label>
                        <input name="engine" value="{{ old('engine') }}" class="mt-2 w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-200" placeholder="e.g. 1.8L" />
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Name</label>
                        <input name="name" value="{{ old('name') }}" class="mt-2 w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-200" />
                    </div>
                    <div>
                        <label class="text-sm font-semibold">Phone</label>
                        <input name="phone" value="{{ old('phone') }}" class="mt-2 w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-200" />
                    </div>

                    <div class="sm:col-span-2">
                        <label class="text-sm font-semibold">Email</label>
                        <input name="email" type="email" value="{{ old('email') }}" class="mt-2 w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-200" />
                    </div>

                    <div>
                        <label class="text-sm font-semibold">Quantity</label>
                        <input name="quantity" type="number" min="1" value="{{ old('quantity', 1) }}" class="mt-2 w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-200" />
                    </div>
                    <div>
                        <label class="text-sm font-semibold">Preferred contact</label>
                        <select name="preferred_contact" class="mt-2 w-full rounded-xl border border-zinc-200 bg-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-200">
                            <option value="facebook" @selected(old('preferred_contact') === 'facebook')>Facebook</option>
                            <option value="phone" @selected(old('preferred_contact') === 'phone')>Phone</option>
                            <option value="email" @selected(old('preferred_contact') === 'email')>Email</option>
                        </select>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="text-sm font-semibold">Notes</label>
                        <textarea name="notes" rows="4" class="mt-2 w-full rounded-xl border border-zinc-200 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-200" placeholder="Any extra details (left/right side, part number, etc.)">{{ old('notes') }}</textarea>
                    </div>

                    <div class="sm:col-span-2 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <button type="submit" class="inline-flex items-center justify-center rounded-full bg-red-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-red-700">
                            Submit request
                        </button>
                        <a href="{{ config('site.facebook_url') }}" target="_blank" rel="noopener noreferrer" class="text-sm font-semibold text-zinc-700 hover:text-zinc-900">
                            Prefer Facebook? Message us →
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </x-container>
@endsection

