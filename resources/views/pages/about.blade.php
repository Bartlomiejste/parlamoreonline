@extends('layouts.app')

@section('content')
    <section class="bg-bg">
        <div class="max-w-4xl mx-auto px-4 py-16">
            <h1 class="font-title text-4xl">{{ __('about.h1') }}</h1>
            <p class="mt-5 text-lg text-ink/80">{{ __('about.lead') }}</p>

            <div class="mt-10 grid gap-6">
                @foreach (__('about.blocks') as $b)
                    <div class="rounded-2xl bg-snow border border-stone/30 p-7">
                        <div class="flex items-center gap-2 font-semibold">
                            <span class="h-3 w-3 rounded-full bg-accent"></span>
                            {{ $b['title'] }}
                        </div>
                        <p class="mt-3 text-ink/80">{{ $b['text'] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="mt-10">
                <a href="{{ url('/' . app()->getLocale() . '/' . __('routes.contact')) }}"
                    class="inline-flex px-5 py-3 rounded-2xl bg-accent text-white font-semibold shadow hover:opacity-95">
                    {{ __('about.cta') }}
                </a>
            </div>
        </div>
    </section>
@endsection
