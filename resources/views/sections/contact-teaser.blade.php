<section class="bg-bg">
    <div class="max-w-6xl mx-auto px-4 py-16">
        <div class="rounded-[2rem] bg-blush/50 border border-stone/30 p-10 grid md:grid-cols-2 gap-10 items-center">
            <div>
                <h2 class="font-title text-3xl">{{ __('contact_teaser.h2') }}</h2>
                <p class="mt-3 text-ink/80">{{ __('contact_teaser.lead') }}</p>
                <ul class="mt-6 grid gap-3 text-ink/80">
                    @foreach (__('contact_teaser.bullets') as $b)
                        <li class="flex items-start gap-3">
                            <span class="mt-2 h-3 w-3 rounded-full bg-accent"></span>
                            <span>{{ $b }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="rounded-2xl bg-snow border border-stone/30 p-6">
                <div class="font-semibold">{{ __('contact_teaser.box_title') }}</div>
                <p class="mt-2 text-ink/80 text-sm">{{ __('contact_teaser.box_text') }}</p>
                <a href="{{ url('/' . app()->getLocale() . '/' . __('routes.contact')) }}"
                    class="mt-5 inline-flex px-5 py-3 rounded-2xl bg-accent text-white font-semibold shadow hover:opacity-95">
                    {{ __('contact_teaser.cta') }}
                </a>
            </div>
        </div>
    </div>
</section>
