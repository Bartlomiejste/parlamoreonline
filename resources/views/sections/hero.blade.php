<section id="home" class="relative overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 py-16 md:py-24 grid md:grid-cols-2 gap-10 items-center">
        <div>
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-snow border border-stone/30 text-sm">
                <span class="h-2 w-2 rounded-full bg-accent"></span>
                {{ trans('home.badge') }}
            </span>

            <h1 class="mt-5 font-title text-4xl md:text-5xl leading-tight">
                {{ trans('home.h1') }}
            </h1>

            <p class="mt-5 text-lg text-ink/80">
                {{ trans('home.lead') }}
            </p>

            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ url('/' . app()->getLocale() . '/' . __('routes.contact')) }}"
                    class="px-5 py-3 rounded-2xl bg-accent text-white font-semibold shadow hover:opacity-95">
                    {{ trans('home.cta_primary') }}
                </a>

                <a href="{{ url('/' . app()->getLocale() . '/' . __('routes.offer')) }}"
                    class="px-5 py-3 rounded-2xl bg-snow border border-stone/30 font-semibold hover:border-accent">
                    {{ trans('home.cta_secondary') }}
                </a>
            </div>

            <div class="mt-10 grid grid-cols-1 sm:grid-cols-3 gap-3 text-sm">
                @foreach (trans('home.highlights') as $h)
                    <div class="bg-snow border border-stone/30 rounded-2xl p-4">
                        <div class="flex items-center gap-2 font-semibold">
                            <span class="h-3 w-3 rounded-full bg-accent"></span>
                            {{ $h['title'] }}
                        </div>
                        <p class="mt-2 text-ink/70">{{ $h['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="relative">
            <div class="aspect-[4/3] rounded-[2rem] bg-blush border border-stone/30 shadow overflow-hidden relative">
                {{-- placeholder "kółka" --}}
                <div class="absolute -top-10 -left-10 h-44 w-44 rounded-full bg-accent/30"></div>
                <div class="absolute top-12 right-10 h-56 w-56 rounded-full bg-ink/10"></div>
                <div class="absolute bottom-10 left-16 h-40 w-40 rounded-full bg-mint/40"></div>

                <div class="absolute inset-0 p-8 flex flex-col justify-end">
                    <div class="bg-snow/80 backdrop-blur rounded-2xl p-5 border border-stone/30">
                        <div class="font-semibold">{{ trans('home.card_title') }}</div>
                        <p class="mt-2 text-ink/80 text-sm">{{ trans('home.card_text') }}</p>
                    </div>
                </div>
            </div>
            <p class="mt-3 text-sm text-ink/60">
                {{ trans('home.note') }}
            </p>
        </div>
    </div>
</section>
