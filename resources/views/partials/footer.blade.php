<footer class="mt-16 bg-snow border-t border-stone/30" role="contentinfo">
    <div class="max-w-6xl mx-auto px-4 py-12 flex flex-col items-center text-center gap-6">

        {{-- LOGO --}}
        <div>
            <img src="{{ asset('assets/logo.png') }}" alt="{{ __('seo.logo_alt') }}" class="h-20 mx-auto" loading="lazy">
        </div>

        {{-- OPIS --}}
        <p class="text-ink/80 max-w-xl">
            {{ __('footer.short') }}
        </p>

        {{-- IKONY SOCIAL --}}
        <nav class="flex gap-6 mt-2" aria-label="{{ __('footer.social') }}">
            {{-- Facebook --}}
            <a href="https://www.facebook.com/profile.php?id=61586056376364" target="_blank" rel="noopener noreferrer"
                aria-label="Facebook" class="hover:opacity-80 transition">
                <img src="{{ asset('assets/footer/facebook.png') }}" alt="Facebook" class="h-8 w-8" loading="lazy">
            </a>

            {{-- Instagram --}}
            <a href="https://www.instagram.com/parlamore_online" target="_blank" rel="noopener noreferrer"
                aria-label="Instagram" class="hover:opacity-80 transition">
                <img src="{{ asset('assets/footer/instagram.png') }}" alt="Instagram" class="h-8 w-8" loading="lazy">
            </a>

            {{-- Email --}}
            <a href="mailto:parlamoreonline@gmail.com" aria-label="{{ __('footer.email') }}"
                class="hover:opacity-80 transition">
                <img src="{{ asset('assets/footer/gmail.png') }}" alt="{{ __('footer.email') }}" class="h-8 w-8"
                    loading="lazy">
            </a>
        </nav>

    </div>

    <div class="border-t border-stone/30 py-4 text-center text-sm text-ink/60">
        © {{ date('Y') }} Parlamore Online
    </div>
</footer>
