<section class="bg-bg">
    <div class="max-w-6xl mx-auto px-4 py-16">
        <div class="flex items-end justify-between gap-6 flex-wrap">
            <div>
                <h2 class="font-title text-3xl">{{ __('reviews_teaser.h2') }}</h2>
                <p class="mt-3 text-ink/80">{{ __('reviews_teaser.lead') }}</p>
            </div>
            <a href="{{ url('/' . app()->getLocale() . '/' . __('routes.reviews')) }}"
                class="px-4 py-2 rounded-2xl bg-snow border border-stone/30 font-semibold hover:border-accent">
                {{ __('reviews_teaser.cta') }}
            </a>
        </div>

        <div class="mt-10 grid md:grid-cols-3 gap-5">
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
