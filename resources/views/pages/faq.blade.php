@extends('layouts.app')

@section('content')
    <section class="bg-bg" aria-labelledby="faq-title">
        <div class="max-w-4xl mx-auto px-4 py-16">

            <h1 id="faq-title" class="font-title text-4xl">
                {{ __('faq.h1') }}
            </h1>

            <p class="mt-5 text-lg text-ink/80">
                {{ __('faq.lead') }}
            </p>

            <ul class="mt-10 grid gap-3">
                @foreach (__('faq.items') as $index => $item)
                    <li class="list-none">
                        <div x-data="{ open: false }" class="rounded-2xl bg-snow border border-stone/30 p-6">
                            <button type="button"
                                class="w-full flex items-start justify-between gap-4 text-left font-semibold"
                                @click="open=!open" :aria-expanded="open.toString()"
                                aria-controls="faq-answer-{{ $index }}">
                                <span>{{ $item['q'] }}</span>
                                <span class="text-accent" x-text="open ? '–' : '+'" aria-hidden="true"></span>
                            </button>

                            <div id="faq-answer-{{ $index }}" class="mt-3 text-ink/80" x-show="open" x-cloak>
                                {{ $item['a'] }}
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>

        </div>
    </section>
@endsection
