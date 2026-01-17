@extends('layouts.app')

@section('content')
    <section class="bg-bg">
        <div class="max-w-5xl mx-auto px-4 py-16">
            <h1 class="font-title text-4xl">{{ __('reviews.h1') }}</h1>
            <p class="mt-5 text-lg text-ink/80">{{ __('reviews.lead') }}</p>

            <div class="mt-10 grid md:grid-cols-2 gap-5">
                @foreach (__('reviews.items') as $r)
                    <figure class="rounded-2xl bg-snow border border-stone/30 p-6">
                        <div class="flex items-center gap-3">
                            <div class="h-10 w-10 rounded-full bg-accent/20 border border-accent/30"></div>
                            <div>
                                <div class="font-semibold">{{ $r['name'] }}</div>
                                <div class="text-sm text-ink/60">{{ $r['tag'] }}</div>
                            </div>
                        </div>
                        <blockquote class="mt-4 text-ink/80">“{{ $r['text'] }}”</blockquote>
                    </figure>
                @endforeach
            </div>
        </div>
    </section>
@endsection
