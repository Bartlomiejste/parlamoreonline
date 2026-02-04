@extends('layouts.app')
@php
    $loc = request()->route('locale') ?? app()->getLocale();
@endphp

@section('content')
    <section class="bg-bg" aria-labelledby="offer-title">
        <div class="max-w-5xl mx-auto px-4 py-16">

            <h1 id="offer-title" class="font-title text-4xl">
                {{ __('offer.h1') }}
            </h1>

            <p class="mt-5 text-lg text-ink/80">
                {{ __('offer.lead') }}
            </p>

            <ul class="mt-10 grid md:grid-cols-3 gap-5">
                @foreach (__('offer.cards') as $c)
                    <li class="list-none h-full">
                        <article class="h-full rounded-2xl bg-snow border border-stone/30 p-7 flex flex-col">
                            <div class="font-semibold flex items-center gap-2">
                                <span class="h-3 w-3 rounded-full bg-accent" aria-hidden="true"></span>
                                {{ $c['title'] }}
                            </div>

                            <ul class="mt-4 grid gap-2 text-sm text-ink/75 flex-1">
                                @foreach ($c['bullets'] as $b)
                                    <li class="flex gap-2">
                                        <span class="text-accent" aria-hidden="true">•</span>
                                        <span>{{ $b }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </article>
                    </li>
                @endforeach
            </ul>


            <div class="mt-10">
                <a href="{{ url('/' . $loc . '/' . trans('routes.contact', [], $loc)) }}"
                    class="inline-flex px-5 py-3 rounded-2xl bg-accent text-white font-semibold shadow hover:opacity-95"
                    aria-label="{{ __('offer.cta_aria') }}">
                    {{ __('offer.cta') }}
                </a>
            </div>

        </div>
    </section>
@endsection
