<section class="bg-snow border-y border-stone/30" aria-labelledby="offer-teaser-title">
    <div class="max-w-6xl mx-auto px-4 py-16">

        <div class="flex items-end justify-between gap-6 flex-wrap">
            <div>
                <h2 id="offer-teaser-title" class="font-title text-3xl">
                    {{ __('offer_teaser.h2') }}
                </h2>
            </div>

            <a href="{{ url('/' . app()->getLocale() . '/' . __('routes.offer')) }}"
                class="px-5 py-3 rounded-2xl bg-accent text-white font-semibold shadow hover:opacity-95"
                aria-label="{{ __('offer_teaser.cta_aria') }}">
                {{ __('offer_teaser.cta') }}
            </a>
        </div>

        <ul class="mt-10 grid md:grid-cols-3 gap-5">
            @foreach (__('offer_teaser.cards') as $c)
                <li class="rounded-2xl border border-stone/30 bg-bg p-6 list-none">
                    <div class="flex items-center gap-2 font-semibold">
                        <span class="h-3 w-3 rounded-full bg-accent" aria-hidden="true"></span>
                        {{ $c['title'] }}
                    </div>

                    <p class="mt-3 text-ink/80">
                        {{ $c['text'] }}
                    </p>
                </li>
            @endforeach
        </ul>

    </div>
</section>
