@extends('layouts.app')
@php
    use App\Support\SchemaBuilder;
    $schema = SchemaBuilder::breadcrumbs('blog_index');
@endphp
@include('seo.breadcrumbs-jsonld', ['schema' => $schema])

@section('content')
    <section class="bg-bg">
        <div class="max-w-5xl mx-auto px-4 py-16">
            <h1 class="font-title text-4xl">{{ __('blog.h1') }}</h1>
            <p class="mt-5 text-lg text-ink/80">{{ __('blog.lead') }}</p>

            <div class="mt-10 grid md:grid-cols-2 gap-5">
                @foreach ($posts as $p)
                    <a href="{{ url('/' . app()->getLocale() . '/blog/' . $p['id'] . '-' . $p['slug']) }}"
                        class="rounded-2xl bg-snow border border-stone/30 p-7 hover:border-accent transition">
                        <div class="font-semibold flex items-center gap-2">
                            <span class="h-3 w-3 rounded-full bg-accent"></span>
                            {{ $p['title'] }}
                        </div>
                        <p class="mt-3 text-ink/80">{{ $p['excerpt'] }}</p>
                        <div class="mt-4 text-sm text-ink/60">{{ $p['date'] }}</div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endsection
