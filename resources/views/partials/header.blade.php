@php
    $loc = app()->getLocale();
    $base = "/{$loc}";
@endphp

<header class="sticky top-0 z-50 bg-bg/90 backdrop-blur border-b border-stone/30">
    <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between gap-4">
        <a href="{{ url($base) }}" class="flex items-center gap-3 py-1">
            <img src="{{ asset('/assets/logo.png') }}" alt="Parlamore Online logo"
                class="h-12 md:h-14 w-auto transition-transform hover:scale-[1.02]">
        </a>


        <nav x-data="{ open: false }" class="flex items-center gap-4">
            <button class="md:hidden px-3 py-2 rounded-xl bg-snow shadow" @click="open=!open"
                :aria-expanded="open.toString()">
                ☰
            </button>

            <ul class="hidden md:flex items-center gap-6 font-semibold">
                <li><a class="hover:text-accent" href="{{ url($base) }}#home">{{ __('nav.home') }}</a></li>
                <li><a class="hover:text-accent"
                        href="{{ url($base . '/' . __('routes.about')) }}">{{ __('nav.about') }}</a></li>
                <li><a class="hover:text-accent"
                        href="{{ url($base . '/' . __('routes.offer')) }}">{{ __('nav.offer') }}</a></li>
                <li><a class="hover:text-accent" href="{{ url($base . '/faq') }}">{{ __('nav.faq') }}</a></li>
                <li><a class="hover:text-accent"
                        href="{{ url($base . '/' . __('routes.reviews')) }}">{{ __('nav.reviews') }}</a></li>
                <li><a class="hover:text-accent"
                        href="{{ url($base . '/' . __('routes.contact')) }}">{{ __('nav.contact') }}</a></li>
                <li><a class="hover:text-accent" href="{{ url($base . '/blog') }}">{{ __('nav.blog') }}</a></li>
            </ul>

            {{-- języki --}}
            <div class="hidden md:flex items-center gap-2">
                @foreach (['pl' => 'PL', 'en' => 'EN', 'it' => 'IT'] as $k => $label)
                    <a class="px-2 py-1 rounded-lg border border-stone/30 hover:border-accent hover:text-accent
                            {{ app()->getLocale() === $k ? 'border-accent text-accent' : '' }}"
                        href="{{ $localeLinks[$k] ?? url('/' . $k) }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>


            {{-- mobile menu --}}
            <div class="md:hidden" x-show="open" x-cloak @click.outside="open=false">
                <div class="absolute right-4 top-16 w-64 bg-snow rounded-2xl shadow p-4 border border-stone/30">
                    <div class="flex gap-2 mb-3">
                        @foreach (['pl' => 'PL', 'en' => 'EN', 'it' => 'IT'] as $k => $label)
                            <a class="px-2 py-1 rounded-lg border border-stone/30 hover:border-accent hover:text-accent
                                    {{ app()->getLocale() === $k ? 'border-accent text-accent' : '' }}"
                                href="{{ $localeLinks[$k] ?? url('/' . $k) }}">
                                {{ $label }}
                            </a>
                        @endforeach
                    </div>

                    <ul class="grid gap-2 font-semibold">
                        <li><a class="hover:text-accent" href="{{ url($base) }}#home">{{ __('nav.home') }}</a></li>
                        <li><a class="hover:text-accent"
                                href="{{ url($base . '/' . __('routes.about')) }}">{{ __('nav.about') }}</a></li>
                        <li><a class="hover:text-accent"
                                href="{{ url($base . '/' . __('routes.offer')) }}">{{ __('nav.offer') }}</a></li>
                        <li><a class="hover:text-accent" href="{{ url($base . '/faq') }}">{{ __('nav.faq') }}</a></li>
                        <li><a class="hover:text-accent"
                                href="{{ url($base . '/' . __('routes.reviews')) }}">{{ __('nav.reviews') }}</a></li>
                        <li><a class="hover:text-accent"
                                href="{{ url($base . '/' . __('routes.contact')) }}">{{ __('nav.contact') }}</a></li>
                        <li><a class="hover:text-accent" href="{{ url($base . '/blog') }}">{{ __('nav.blog') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
