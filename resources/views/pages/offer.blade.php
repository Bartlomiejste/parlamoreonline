@extends('layouts.app')

@section('content')
    <section class="bg-bg">
        <div class="max-w-5xl mx-auto px-4 py-16">
            <h1 class="font-title text-4xl">{{ __('offer.h1') }}</h1>
            <p class="mt-5 text-lg text-ink/80">{{ __('offer.lead') }}</p>

            <div class="mt-10 grid md:grid-cols-3 gap-5">
                @foreach (__('offer.cards') as $c)
                    <div class="rounded-2xl bg-snow border border-stone/30 p-7">
                        <div class="font-semibold flex items-center gap-2">
                            <span class="h-3 w-3 rounded-full bg-accent"></span>
                            {{ $c['title'] }}
                        </div>
                        <p class="mt-3 text-ink/80">{{ $c['text'] }}</p>
                        <ul class="mt-4 grid gap-2 text-sm text-ink/75">
                            @foreach ($c['bullets'] as $b)
                                <li class="flex gap-2">
                                    <span class="text-accent">•</span> <span>{{ $b }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>

            <div class="mt-10 rounded-2xl bg-blush/50 border border-stone/30 p-7">
                <div class="font-semibold">{{ __('offer.bundle_title') }}</div>
                <ul class="mt-4 grid gap-2 text-ink/80">
                    @foreach (__('offer.bundle') as $b)
                        <li class="flex items-start gap-3">
                            <span class="mt-2 h-3 w-3 rounded-full bg-accent"></span>
                            <span>{{ $b }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="mt-10">
                <a href="{{ url('/' . app()->getLocale() . '/' . __('routes.contact')) }}"
                    class="inline-flex px-5 py-3 rounded-2xl bg-accent text-white font-semibold shadow hover:opacity-95">
                    {{ __('offer.cta') }}
                </a>
            </div>
        </div>
    </section>
@endsection
