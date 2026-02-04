@extends('layouts.app')

@section('content')
    <section class="bg-bg" aria-labelledby="reviews-title">
        <div class="max-w-5xl mx-auto px-4 py-16">

            <h1 id="reviews-title" class="font-title text-4xl">
                {{ __('reviews.h1') }}
            </h1>

            <p class="mt-5 text-lg text-ink/80">
                {{ __('reviews.lead') }}
            </p>

            <ul class="mt-10 grid md:grid-cols-2 gap-5">
                @foreach (__('reviews.items') as $r)
                    <li class="list-none h-full">
                        <figure class="h-full rounded-2xl bg-snow border border-stone/30 p-6 flex flex-col">
                            <div class="grid grid-cols-[auto_1fr] gap-4 items-start flex-1">

                                {{-- LEWA KOLUMNA --}}
                                <div class="flex flex-col items-start gap-1 md:min-w-[120px] min-w-0">
                                    <div class="font-semibold text-lg">
                                        {{ $r['name'] }}
                                    </div>

                                    <div class="text-accent text-sm leading-none" aria-label="5 na 5 gwiazdek">
                                        ★★★★★
                                    </div>

                                    @if (!empty($r['date']))
                                        <time class="text-sm text-ink/60" datetime="{{ $r['date_iso'] ?? '' }}">
                                            {{ $r['date'] }}
                                        </time>
                                    @endif

                                    @if (!empty($r['tag']))
                                        <div class="text-sm text-ink/60">
                                            {{ $r['tag'] }}
                                        </div>
                                    @endif
                                </div>

                                {{-- PRAWA KOLUMNA --}}
                                <blockquote class="text-ink/80 leading-relaxed">
                                    “{{ $r['text'] }}”
                                </blockquote>

                            </div>
                        </figure>
                    </li>
                @endforeach
            </ul>

        </div>
    </section>
@endsection
