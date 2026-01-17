<section class="bg-snow border-y border-stone/30">
    <div class="max-w-6xl mx-auto px-4 py-16">
        <div class="flex items-end justify-between gap-6 flex-wrap">
            <div>
                <h2 class="font-title text-3xl">{{ __('faq_teaser.h2') }}</h2>
                <p class="mt-3 text-ink/80">{{ __('faq_teaser.lead') }}</p>
            </div>
            <a href="{{ url('/' . app()->getLocale() . '/faq') }}"
                class="px-4 py-2 rounded-2xl bg-bg border border-stone/30 font-semibold hover:border-accent">
                {{ __('faq_teaser.cta') }}
            </a>
        </div>

        <div class="mt-8 grid gap-3">
            @foreach (array_slice(__('faq.items'), 0, 5) as $item)
                <div x-data="{ open: false }" class="rounded-2xl bg-bg border border-stone/30 p-5">
                    <button class="w-full flex items-start justify-between gap-4 text-left font-semibold"
                        @click="open=!open" :aria-expanded="open.toString()">
                        <span>{{ $item['q'] }}</span>
                        <span class="text-accent" x-text="open ? '–' : '+'"></span>
                    </button>
                    <div class="mt-3 text-ink/80" x-show="open" x-cloak>
                        {{ $item['a'] }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
