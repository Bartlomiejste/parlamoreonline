<?php

namespace App\Support;

class LocaleSwitcher
{
    /**
     * Build locale-aware links that keep the current page.
     * Supports: home, about, offer, faq, reviews, contact, blog index, blog show.
     */
    public static function links(): array
    {
        $locales = config('seo.locales', ['pl','en','it']);

        $path = request()->path(); // e.g. "it/offerta" or "en/blog/restaurant-italian-at-a-restaurant-mini-dialogue"
        $parts = array_values(array_filter(explode('/', $path), fn($p) => $p !== ''));

        $currentLocale = $parts[0] ?? 'pl';
        $rest = array_slice($parts, 1); // path without locale

        $pageKey = self::detectPageKey($currentLocale, $rest);

        $links = [];
        foreach ($locales as $loc) {
            $links[$loc] = self::buildUrlFor($loc, $pageKey, $rest);
        }

        return $links;
    }

    private static function detectPageKey(string $locale, array $rest): string
    {
        if (count($rest) === 0) return 'home';

        if ($rest[0] === 'blog') return 'blog';
        if ($rest[0] === 'faq') return 'faq';

        $about   = trans("routes.about", [], $locale);
        $offer   = trans("routes.offer", [], $locale);
        $reviews = trans("routes.reviews", [], $locale);
        $contact = trans("routes.contact", [], $locale);

        if ($rest[0] === $about) return 'about';
        if ($rest[0] === $offer) return 'offer';
        if ($rest[0] === $reviews) return 'reviews';
        if ($rest[0] === $contact) return 'contact';

        return 'home';
    }

    private static function buildUrlFor(string $targetLocale, string $pageKey, array $rest): string
    {
        // BLOG (index/show with id-slug)
        if ($pageKey === 'blog') {
            // rest: ["blog"] or ["blog", "{id}-{slug}"]
            if (count($rest) >= 2) {
                $second = $rest[1];
                $id = explode('-', $second, 2)[0];

                $targetPosts = trans('blog.posts', [], $targetLocale);
                $target = collect($targetPosts)->firstWhere('id', $id);

                if ($target) {
                    return url("/{$targetLocale}/blog/{$id}-{$target['slug']}");
                }
                return url("/{$targetLocale}/blog");
            }
            return url("/{$targetLocale}/blog");
        }

        // FAQ (same slug)
        if ($pageKey === 'faq') {
            return url("/{$targetLocale}/faq");
        }

        // Localized pages
        if (in_array($pageKey, ['about','offer','reviews','contact'], true)) {
            $slug = trans("routes.{$pageKey}", [], $targetLocale);
            return url("/{$targetLocale}/{$slug}");
        }

        // HOME fallback
        return url("/{$targetLocale}");
    }
}