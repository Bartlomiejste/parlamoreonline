<section class="bg-bg" aria-labelledby="reviews-teaser-title">
    <div class="max-w-6xl mx-auto px-4 py-16">

        <div class="flex items-end justify-between gap-6 flex-wrap">
            <div>
                <h2 id="reviews-teaser-title" class="font-title text-3xl font-bold">
                    {{ __('reviews_teaser.h2') }}
                </h2>

                <p class="mt-3 text-ink/80">
                    {{ __('reviews_teaser.lead') }}
                </p>
            </div>

            <a href="{{ url('/' . app()->getLocale() . '/' . __('routes.reviews')) }}"
                class="px-4 py-2 rounded-2xl bg-snow border border-stone/30 font-semibold hover:border-accent transition"
                aria-label="{{ __('reviews_teaser.cta_aria') }}">
                {{ __('reviews_teaser.cta') }}
            </a>
        </div>

        <ul class="mt-10 grid gap-5">
            @foreach (__('reviews.items') as $r)
                @php
                    $rating = (int) ($r['rating'] ?? 5);
                @endphp

                <li class="list-none">
                    <article class="rounded-2xl bg-snow border border-stone/30 p-6">
                        <div class="grid md:grid-cols-[220px_1fr] gap-6 items-start">

                            {{-- LEWA KOLUMNA --}}
                            <div>
                                <div class="font-semibold text-lg">
                                    {{ $r['name'] }}
                                </div>

                                @if (!empty($r['date']))
                                    <time class="mt-2 block text-sm text-ink/60" datetime="{{ $r['date_iso'] ?? '' }}">
                                        {{ $r['date'] }}
                                    </time>
                                @endif

                                @if (!empty($r['tag']))
                                    <div class="mt-1 text-sm text-ink/60">
                                        {{ $r['tag'] }}
                                    </div>
                                @endif
                            </div>

                            {{-- PRAWA KOLUMNA --}}
                            <div>
                                <blockquote class="text-ink/80 leading-relaxed">
                                    “{{ $r['text'] }}”
                                </blockquote>
                            </div>

                        </div>
                    </article>
                </li>
            @endforeach
        </ul>

    </div>
</section>
