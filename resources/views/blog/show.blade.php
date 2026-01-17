@extends('layouts.app')
@php
    use App\Support\SchemaBuilder;

    $canonicalUrl = $canonical ?? url()->current();

    $breadcrumbsSchema = SchemaBuilder::breadcrumbs('blog_post', [
        'title' => $post['title'] ?? 'Post',
        'url' => $canonicalUrl,
    ]);

    $blogPostingSchema = SchemaBuilder::blogPosting($post, $canonicalUrl);
@endphp
@include('seo.breadcrumbs-jsonld', ['schema' => $breadcrumbsSchema])
@include('seo.blogposting-jsonld', ['schema' => $blogPostingSchema])

@section('content')
    <section class="bg-bg">
        <div class="max-w-3xl mx-auto px-4 py-16">
            <a href="{{ route('blog', ['locale' => app()->getLocale()]) }}" class="text-sm font-semibold text-accent">
                ← {{ __('blog.back') }}
            </a>

            <h1 class="mt-4 font-title text-4xl">{{ $post['title'] }}</h1>
            <p class="mt-3 text-ink/60">{{ $post['date'] }}</p>

            <article class="mt-8 prose prose-lg max-w-none">
                @foreach ($post['content'] as $para)
                    <p class="text-ink/80 leading-relaxed">{{ $para }}</p>
                @endforeach
            </article>
        </div>
    </section>
@endsection
