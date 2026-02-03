<section class="bg-snow border-y border-stone/30" aria-labelledby="faq-teaser-title">
    <div class="max-w-6xl mx-auto px-4 py-16">
        <div class="flex items-end justify-between gap-6 flex-wrap">
            <div>
                <h2 id="faq-teaser-title" class="font-title text-3xl">
                    {{ __('faq_teaser.h2') }}
                </h2>
            </div>

            <a href="{{ url('/' . app()->getLocale() . '/faq') }}"
                class="px-5 py-3 rounded-2xl bg-accent text-white font-semibold shadow hover:opacity-95"
                aria-label="{{ __('faq_teaser.cta_aria') }}">
                {{ __('faq_teaser.cta') }}
            </a>
        </div>

        <div class="mt-8 grid gap-3">
            @foreach (array_slice(__('faq.items'), 0, 3) as $index => $item)
                <div x-data="{ open: false }" class="rounded-2xl bg-bg border border-stone/30 p-5">
                    <button type="button" class="w-full flex items-start justify-between gap-4 text-left font-semibold"
                        @click="open = !open" :aria-expanded="open.toString()"
                        aria-controls="faq-answer-{{ $index }}">
                        <span>{{ $item['q'] }}</span>
                        <span class="text-accent" x-text="open ? '–' : '+'"></span>
                    </button>

                    <div id="faq-answer-{{ $index }}" class="mt-3 text-ink/80" x-show="open" x-cloak>
                        {{ $item['a'] }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
