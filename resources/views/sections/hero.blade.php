@php
    $loc = app()->getLocale();
    $aboutUrl = url('/' . $loc . '/' . __('routes.about'));
@endphp

<section id="home" class="relative w-full overflow-hidden bg-bg" aria-labelledby="hero-title">
    <div class="relative h-[50vh] min-h-[850px]">

        {{-- VIDEO TŁO --}}
        <video class="absolute inset-0 w-full h-full object-cover" autoplay muted loop playsinline preload="auto"
            poster="{{ asset('assets/hero_airplane.png') }}">
            <source src="{{ asset('assets/hero_airplanefilm.mp4') }}" type="video/mp4">
        </video>

        {{-- overlay --}}
        <div class="absolute inset-0 bg-black/30" aria-hidden="true"></div>

        {{-- treść --}}
        <div class="relative z-10 flex h-full items-center justify-center text-center px-6">
            <div class="max-w-3xl">

                <h1 id="hero-title" class="font-title text-3xl md:text-5xl font-bold text-white leading-snug">
                    {{ trans('home.hero_img_title') }}
                </h1>

                <p class="mt-4 text-base md:text-lg text-white/80 max-w-2xl mx-auto font-medium">
                    {{ trans('home.hero_img_lead') }}
                </p>

                <a href="{{ $aboutUrl }}"
                    class="mt-6 inline-flex px-8 py-3 rounded-full bg-accent text-white font-bold shadow hover:opacity-95 transition"
                    aria-label="{{ __('home.hero_more_aria') }}">
                    {{ trans('home.hero_more') }}
                </a>

            </div>
        </div>
    </div>
</section>
