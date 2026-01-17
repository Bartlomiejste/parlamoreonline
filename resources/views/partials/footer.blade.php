<footer class="mt-16 bg-snow border-t border-stone/30">
    <div class="max-w-6xl mx-auto px-4 py-10 grid md:grid-cols-3 gap-10">
        <div>
            <div class="font-title text-2xl">Parlamore Online</div>
            <p class="mt-3 text-ink/80">
                {{ __('footer.short') }}
            </p>
        </div>

        <div>
            <div class="font-semibold mb-3">{{ __('footer.menu') }}</div>
            <ul class="grid gap-2">
                <li><a class="hover:text-accent" href="{{ url('/' . app()->getLocale()) }}#home">{{ __('nav.home') }}</a>
                </li>
                <li><a class="hover:text-accent"
                        href="{{ url('/' . app()->getLocale() . '/' . __('routes.offer')) }}">{{ __('nav.offer') }}</a></li>
                <li><a class="hover:text-accent" href="{{ url('/' . app()->getLocale() . '/faq') }}">{{ __('nav.faq') }}</a>
                </li>
                <li><a class="hover:text-accent"
                        href="{{ url('/' . app()->getLocale() . '/' . __('routes.contact')) }}">{{ __('nav.contact') }}</a>
                </li>
            </ul>
        </div>

        <div>
            <div class="font-semibold mb-3">{{ __('footer.contact') }}</div>
            <p class="text-ink/80">{{ config('seo.email_to') }}</p>
            <p class="text-ink/70 mt-2 text-sm">{{ __('footer.legal') }}</p>
        </div>
    </div>

    <div class="border-t border-stone/30 py-4 text-center text-sm text-ink/60">
        © {{ date('Y') }} Parlamore Online
    </div>
</footer>
