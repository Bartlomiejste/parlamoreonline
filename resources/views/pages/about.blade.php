@extends('layouts.app')

@php
    $title = __('about.meta_title');
    $desc = __('about.meta_desc');
    $photo = asset('assets/about/aboutme.png');
    $loc = request()->route('locale') ?? app()->getLocale();
@endphp

@section('content')
    <section class="bg-bg" aria-labelledby="about-title">
        <div class="max-w-6xl mx-auto px-4 py-16">

            {{-- TOP: tekst + zdjęcie --}}
            <div class="grid md:grid-cols-[1.3fr_.7fr] gap-10 items-start">

                {{-- TEKST --}}
                <div>
                    <h1 id="about-title" class="font-title text-4xl md:text-5xl font-bold">
                        {{ __('about.h1') }}
                    </h1>

                    <div class="mt-5 space-y-3 text-base md:text-lg text-ink/80 leading-relaxed max-w-prose">
                        <p>{!! __('about.intro.p1') !!}</p>
                        <p>{!! __('about.intro.p2') !!}</p>
                        <p>{!! __('about.intro.p3') !!}</p>
                        <p>{!! __('about.intro.p4') !!}</p>
                        <p>{!! __('about.intro.p5') !!}</p>
                        <p>{!! __('about.intro.p6') !!}</p>
                        <p>{!! __('about.intro.p7') !!}</p>
                    </div>
                </div>

                {{-- ZDJĘCIE --}}
                <aside class="flex justify-center md:justify-end" aria-label="{{ __('about.photo_label') }}">
                    <img src="{{ $photo }}" alt="{{ __('about.photo_alt') }}"
                        class="
                            w-full
                            max-w-[260px] sm:max-w-[320px] md:max-w-none
                            h-auto
                            rounded-2xl
                            object-cover
                        "
                        loading="eager" fetchpriority="high">
                </aside>

            </div>

            {{-- CTA --}}
            <div class="mt-10 flex justify-center md:justify-start">
                <a href="{{ url('/' . $loc . '/' . trans('routes.contact', [], $loc)) }}"
                    class="inline-flex px-6 py-3 rounded-2xl bg-accent text-white font-semibold shadow hover:opacity-95 transition"
                    aria-label="{{ __('about.cta_aria') }}">
                    {{ __('about.cta') }}
                </a>
            </div>

        </div>
    </section>
@endsection
