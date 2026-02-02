<section class="bg-bg" aria-labelledby="how-title">
    <div class="max-w-6xl mx-auto px-4 py-16">

        <h2 id="how-title" class="font-title text-3xl">
            {{ __('how.h2') }}
        </h2>

        <p class="mt-3 text-ink/80 max-w-3xl">
            {{ __('how.lead') }}
        </p>

        <ol class="mt-10 grid md:grid-cols-4 gap-5">
            @foreach (__('how.steps') as $i => $s)
                <li class="rounded-2xl bg-snow border border-stone/30 p-6 list-none">
                    <div class="h-10 w-10 rounded-full bg-accent/20 border border-accent/30 flex items-center justify-center font-bold"
                        aria-hidden="true">
                        {{ $i + 1 }}
                    </div>

                    <div class="mt-4 font-semibold">
                        {{ $s['title'] }}
                    </div>

                    <p class="mt-2 text-ink/75 text-sm">
                        {{ $s['text'] }}
                    </p>
                </li>
            @endforeach
        </ol>

    </div>
</section>
