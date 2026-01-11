<footer class="border-t border-zinc-200 bg-white">
    <x-container class="py-10">
        <div class="grid gap-6 md:grid-cols-3">
            <div>
                <div class="text-base font-semibold text-zinc-900">{{ config('site.name') }}</div>
                <p class="mt-2 text-sm text-zinc-600">{{ config('site.tagline') }}</p>
            </div>

            <div class="text-sm text-zinc-600">
                <div class="font-semibold text-zinc-900">Contact</div>
                <ul class="mt-2 space-y-1">
                    <li>Phone: {{ filled(config('site.phone')) ? config('site.phone') : '(add)' }}</li>
                    <li>Email: {{ filled(config('site.email')) ? config('site.email') : '(add)' }}</li>
                    <li>Hours: {{ filled(config('site.hours')) ? config('site.hours') : '(add)' }}</li>
                </ul>
            </div>

            <div class="text-sm text-zinc-600">
                <div class="font-semibold text-zinc-900">Links</div>
                <ul class="mt-2 space-y-1">
                    <li>
                        <a
                            href="{{ config('site.facebook_url') }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="hover:text-zinc-900"
                        >
                            Facebook page
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/contact') }}" class="hover:text-zinc-900">Request a quote</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-8 border-t border-zinc-200 pt-6 text-xs text-zinc-500">
            © {{ now()->year }} {{ config('site.name') }}. All rights reserved.
        </div>
    </x-container>
</footer>

