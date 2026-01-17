<section class="bg-blush/40 border-y border-stone/30">
    <div class="max-w-6xl mx-auto px-4 py-16 grid md:grid-cols-2 gap-10">
        <div>
            <h2 class="font-title text-3xl">{{ __('forwho.h2') }}</h2>
            <p class="mt-3 text-ink/80">{{ __('forwho.lead') }}</p>

            <ul class="mt-6 grid gap-3">
                @foreach (__('forwho.bullets') as $b)
                    <li class="flex gap-3 items-start">
                        <span class="mt-2 h-3 w-3 rounded-full bg-accent"></span>
                        <span class="text-ink/80">{{ $b }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="rounded-[2rem] bg-snow border border-stone/30 p-8 shadow">
            <div class="font-semibold">{{ __('forwho.box_title') }}</div>
            <p class="mt-3 text-ink/80">{{ __('forwho.box_text') }}</p>

            <div class="mt-6 flex flex-wrap gap-3">
                <a class="px-5 py-3 rounded-2xl bg-accent text-white font-semibold shadow hover:opacity-95"
                    href="{{ url('/' . app()->getLocale() . '/' . __('routes.contact')) }}">
                    {{ __('forwho.cta') }}
                </a>
                <a class="px-5 py-3 rounded-2xl bg-bg border border-stone/30 font-semibold hover:border-accent"
                    href="{{ url('/' . app()->getLocale() . '/' . __('routes.offer')) }}">
                    {{ __('forwho.cta2') }}
                </a>
            </div>
        </div>
    </div>
</section>
