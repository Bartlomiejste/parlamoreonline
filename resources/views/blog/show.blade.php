@extends('layouts.app')

@php
    use App\Support\SchemaBuilder;

    $canonicalUrl = $canonical ?? url()->current();

    $breadcrumbsSchema = SchemaBuilder::breadcrumbs('blog_post', [
        'title' => $post['title'] ?? 'Post',
        'url' => $canonicalUrl,
    ]);

    $blogPostingSchema = SchemaBuilder::blogPosting($post, $canonicalUrl);

    $loc = request()->route('locale') ?? app()->getLocale();

    // Heurystyka stylowania akapitów:
    // - linie zaczynające się od "PIÙ:", "DI PIÙ:", "IN PIÙ:" -> sekcje
    // - "Podsumowanie:" -> box "Podsumowanie"
    // - "Na koniec" -> box "Tip"
    $isSection = fn(string $t) => preg_match('/^(PIÙ|DI PIÙ|IN PIÙ)\s*:/u', trim($t)) === 1;
    $isSummary = fn(string $t) => preg_match('/^Podsumowanie\s*:/u', trim($t)) === 1;
    $isTip = fn(string $t) => preg_match('/^Na koniec/u', trim($t)) === 1;

    $splitLabelBody = function (string $t): array {
        $t = trim($t);
        $parts = preg_split('/\s*:\s*/u', $t, 2);
        if (count($parts) === 2) {
            return [trim($parts[0]), trim($parts[1])];
        }
        return ['', $t];
    };
@endphp

@include('seo.breadcrumbs-jsonld', ['schema' => $breadcrumbsSchema])
@include('seo.blogposting-jsonld', ['schema' => $blogPostingSchema])

@section('content')
    <section class="bg-bg" aria-labelledby="post-title">
        <div class="max-w-3xl mx-auto px-4 py-16">

            <a href="{{ route('blog', ['locale' => $loc]) }}" class="text-sm font-semibold text-accent"
                aria-label="{{ __('blog.back_aria') }}">
                ← {{ __('blog.back') }}
            </a>

            <h1 id="post-title" class="mt-4 font-title text-4xl">
                {{ $post['title'] }}
            </h1>

            @if (!empty($post['date_iso']))
                <time class="mt-3 text-ink/60" datetime="{{ $post['date_iso'] }}">
                    {{ $post['date'] }}
                </time>
            @else
                <p class="mt-3 text-ink/60">{{ $post['date'] }}</p>
            @endif

            <article class="mt-10" aria-label="{{ __('blog.post_content') }}">
                <div class="grid gap-5">

                    @foreach ($post['content'] as $para)
                        @php
                            $t = trim($para);
                        @endphp

                        {{-- Sekcje PIÙ / DI PIÙ / IN PIÙ --}}
                        @if ($isSection($t))
                            @php [$label, $body] = $splitLabelBody($t); @endphp

                            <section class="rounded-2xl bg-snow border border-stone/30 p-6">
                                <div class="flex items-center gap-3">
                                    <span class="h-3 w-3 rounded-full bg-accent" aria-hidden="true"></span>
                                    <h2 class="font-title text-xl">{{ $label }}</h2>
                                </div>
                                <p class="mt-3 text-ink/80 leading-relaxed">
                                    {{ $body }}
                                </p>
                            </section>

                            {{-- Podsumowanie --}}
                        @elseif ($isSummary($t))
                            @php [, $body] = $splitLabelBody($t); @endphp

                            <div class="rounded-2xl bg-bg border border-stone/30 p-6">
                                <div class="font-semibold">Podsumowanie</div>
                                <p class="mt-3 text-ink/80 leading-relaxed">
                                    {{ $body }}
                                </p>
                            </div>

                            {{-- Tip / Na koniec --}}
                        @elseif ($isTip($t))
                            <div class="rounded-2xl bg-blush/40 border border-stone/30 p-6">
                                <div class="font-semibold">Tip</div>
                                <p class="mt-3 text-ink/80 leading-relaxed">
                                    {{ $t }}
                                </p>
                            </div>

                            {{-- Normalny akapit --}}
                        @else
                            <p class="text-ink/80 leading-relaxed text-lg">
                                {{ $t }}
                            </p>
                        @endif
                    @endforeach

                </div>
            </article>

        </div>
    </section>
@endsection
