<section class="bg-blush/40 border-y border-stone/30" aria-labelledby="forwho-title">
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="grid md:grid-cols-2 gap-12 items-center">

            {{-- LEWA: TEKST --}}
            <div>
                <h2 id="forwho-title" class="font-title text-3xl font-bold">
                    {{ __('forwho.h2') }}
                </h2>

                <p class="mt-4 text-ink/80 text-lg">
                    {{ __('forwho.lead') }}
                </p>

                <ul class="mt-8 grid gap-4">
                    @foreach (__('forwho.bullets') as $b)
                        <li class="flex gap-3 items-start">
                            <span class="mt-2 h-3 w-3 rounded-full bg-accent flex-shrink-0" aria-hidden="true"></span>
                            <span class="text-ink/80 leading-relaxed">
                                {{ $b }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- PRAWA: OBRAZ --}}
            <div class="relative">
                <figure class="overflow-hidden rounded-[2rem] border border-stone/30 shadow">
                    <img src="{{ asset('assets/forwho/forwho.png') }}" alt="{{ __('forwho.image_alt') }}"
                        class="w-full h-auto object-cover" loading="lazy">
                </figure>
            </div>

        </div>
    </div>
</section>
