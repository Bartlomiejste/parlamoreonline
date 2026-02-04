@php
    $loc = request()->route('locale') ?? 'pl';
    $base = '/' . $loc;

    $flags = [
        'pl' => ['src' => asset('assets/flags/pl.png'), 'label' => 'Polski'],
        'en' => ['src' => asset('assets/flags/en.png'), 'label' => 'English'],
        'it' => ['src' => asset('assets/flags/it.png'), 'label' => 'Italiano'],
    ];
@endphp

<header class="sticky top-0 z-50 bg-bg/90 backdrop-blur border-b border-stone/30" role="banner">
    <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between gap-4">
        <a href="{{ url($base) }}" class="flex items-center gap-3 py-1" aria-label="{{ __('nav.home') }}">
            <img src="{{ asset('/assets/logo.png') }}" alt="{{ __('seo.logo_alt') }}"
                class="h-12 md:h-14 w-auto transition-transform hover:scale-[1.02]" loading="eager" fetchpriority="high">
        </a>

        <nav x-data="{ open: false }" class="flex items-center gap-4" aria-label="{{ __('nav.main') }}">
            <button type="button" class="md:hidden px-3 py-2 rounded-xl bg-snow shadow fixed z-20 end-10"
                @click="open=!open" :aria-expanded="open.toString()" aria-controls="mobile-menu"
                aria-label="{{ __('nav.toggle') }}">
                ☰
            </button>

            <ul class="hidden md:flex items-center gap-6 font-semibold whitespace-nowrap">
                <li><a class="hover:text-accent whitespace-nowrap"
                        href="{{ url($base) }}#home">{{ __('nav.home') }}</a></li>
                <li><a class="hover:text-accent whitespace-nowrap"
                        href="{{ url($base . '/' . trans('routes.about', [], $loc)) }}">{{ __('nav.about') }}</a></li>
                <li><a class="hover:text-accent whitespace-nowrap"
                        href="{{ url($base . '/' . trans('routes.offer', [], $loc)) }}">{{ __('nav.offer') }}</a></li>
                <li><a class="hover:text-accent whitespace-nowrap"
                        href="{{ url($base . '/faq') }}">{{ __('nav.faq') }}</a></li>
                <li><a class="hover:text-accent whitespace-nowrap"
                        href="{{ url($base . '/' . trans('routes.reviews', [], $loc)) }}">{{ __('nav.reviews') }}</a>
                </li>
                <li><a class="hover:text-accent whitespace-nowrap"
                        href="{{ url($base . '/' . trans('routes.contact', [], $loc)) }}">{{ __('nav.contact') }}</a>
                </li>

                {{-- BLOG TYLKO PRZEZ ROUTE --}}
                <li><a class="hover:text-accent"
                        href="{{ route('blog', ['locale' => $loc]) }}">{{ __('nav.blog') }}</a></li>
            </ul>

            {{-- języki --}}
            <div class="hidden md:flex items-center gap-2" aria-label="{{ __('nav.languages') }}">
                @foreach ($flags as $k => $f)
                    <a class="p-2 rounded-lg border border-stone/30 hover:border-accent transition
                        {{ $loc === $k ? 'border-accent ring-2 ring-accent/20' : '' }}"
                        href="{{ $localeLinks[$k] ?? url('/' . $k) }}" aria-label="{{ $f['label'] }}"
                        title="{{ $f['label'] }}" rel="alternate" hreflang="{{ $k }}">
                        <img src="{{ $f['src'] }}" alt="{{ $f['label'] }}" class="h-5 w-5 rounded-sm"
                            loading="lazy">
                        <span class="sr-only">{{ $f['label'] }}</span>
                    </a>
                @endforeach
            </div>

            {{-- mobile menu --}}
            <div class="md:hidden" x-show="open" x-cloak @click.outside="open=false">
                <div id="mobile-menu"
                    class="absolute right-4 top-16 w-64 bg-snow rounded-2xl shadow p-4 border border-stone/30"
                    role="menu" aria-label="{{ __('nav.mobile') }}">

                    <div class="flex gap-2 mb-3" aria-label="{{ __('nav.languages') }}">
                        @foreach ($flags as $k => $f)
                            <a class="p-2 rounded-lg border border-stone/30 hover:border-accent transition
                                {{ $loc === $k ? 'border-accent ring-2 ring-accent/20' : '' }}"
                                href="{{ $localeLinks[$k] ?? url('/' . $k) }}" aria-label="{{ $f['label'] }}"
                                title="{{ $f['label'] }}" rel="alternate" hreflang="{{ $k }}">
                                <img src="{{ $f['src'] }}" alt="{{ $f['label'] }}" class="h-5 w-5 rounded-sm"
                                    loading="lazy">
                                <span class="sr-only">{{ $f['label'] }}</span>
                            </a>
                        @endforeach
                    </div>

                    <ul class="grid gap-2 font-semibold">
                        <li><a class="hover:text-accent" href="{{ url($base) }}#home">{{ __('nav.home') }}</a></li>
                        <li><a class="hover:text-accent"
                                href="{{ url($base . '/' . trans('routes.about', [], $loc)) }}">{{ __('nav.about') }}</a>
                        </li>
                        <li><a class="hover:text-accent"
                                href="{{ url($base . '/' . trans('routes.offer', [], $loc)) }}">{{ __('nav.offer') }}</a>
                        </li>
                        <li><a class="hover:text-accent" href="{{ url($base . '/faq') }}">{{ __('nav.faq') }}</a></li>
                        <li><a class="hover:text-accent"
                                href="{{ url($base . '/' . trans('routes.reviews', [], $loc)) }}">{{ __('nav.reviews') }}</a>
                        </li>
                        <li><a class="hover:text-accent"
                                href="{{ url($base . '/' . trans('routes.contact', [], $loc)) }}">{{ __('nav.contact') }}</a>
                        </li>
                        <li><a class="hover:text-accent"
                                href="{{ route('blog', ['locale' => $loc]) }}">{{ __('nav.blog') }}</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
