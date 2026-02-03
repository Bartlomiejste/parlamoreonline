<section class="bg-bg" aria-labelledby="contact-teaser-title">
    <div class="max-w-6xl mx-auto px-4 py-16">
        <div class="rounded-[2rem] bg-blush/50 border border-stone/30 p-10 grid md:grid-cols-2 gap-10 items-center">
            <div>
                <h2 id="contact-teaser-title" class="font-title text-2xl">
                    {{ __('contact_teaser.h2') }}
                </h2>
            </div>
            <div class="flex items-center md:justify-center">
                <a href="{{ url('/' . app()->getLocale() . '/' . __('routes.contact')) }}"
                    class="px-5 py-3 rounded-2xl bg-accent text-white font-semibold shadow hover:opacity-95"
                    aria-label="{{ __('contact_teaser.cta_aria') }}">
                    {{ __('contact_teaser.cta') }}
                </a>
            </div>
        </div>
    </div>
</section>
