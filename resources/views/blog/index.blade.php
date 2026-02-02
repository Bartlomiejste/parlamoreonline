@extends('layouts.app')

@php
    use App\Support\SchemaBuilder;

    $schema = SchemaBuilder::breadcrumbs('blog_index');
@endphp

@include('seo.breadcrumbs-jsonld', ['schema' => $schema])

@section('content')
    <section class="bg-bg" aria-labelledby="blog-title">
        <div class="max-w-5xl mx-auto px-4 py-16">

            <h1 id="blog-title" class="font-title text-4xl">
                {{ __('blog.h1') }}
            </h1>

            <p class="mt-5 text-lg text-ink/80">
                {{ __('blog.lead') }}
            </p>

            <ul class="mt-10 grid md:grid-cols-2 gap-5">
                @foreach ($posts as $p)
                    <li class="list-none h-full">
                        <a href="{{ url('/' . app()->getLocale() . '/blog/' . $p['id'] . '-' . $p['slug']) }}"
                            class="h-full rounded-2xl bg-snow border border-stone/30 p-7 hover:border-accent transition flex flex-col"
                            aria-label="{{ __('blog.read_post_aria', ['title' => $p['title']]) }}">
                            <div class="font-semibold flex items-center gap-2">
                                <span class="h-3 w-3 rounded-full bg-accent" aria-hidden="true"></span>
                                {{ $p['title'] }}
                            </div>

                            <p class="mt-3 text-ink/80 flex-1">
                                {{ $p['excerpt'] }}
                            </p>

                            @if (!empty($p['date_iso']))
                                <time class="mt-4 text-sm text-ink/60" datetime="{{ $p['date_iso'] }}">
                                    {{ $p['date'] }}
                                </time>
                            @else
                                <div class="mt-4 text-sm text-ink/60">
                                    {{ $p['date'] }}
                                </div>
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>

        </div>
    </section>
@endsection
