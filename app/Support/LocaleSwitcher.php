<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class LocaleSwitcher
{
    /**
     * Build locale-aware links that keep the current page.
     *
     * Supported:
     * - home
     * - about / offer / reviews / contact (localized slugs from lang/routes.*)
     * - faq (fixed slug "faq")
     * - blog index + blog show (/blog/{id}-{slug}) where slug is translated per locale via lang/blog.posts
     *
     * Keeps query string (?x=1) and fragment (#section) if present.
     */
    public static function links(): array
    {
        $locales = config('seo.locales', ['pl', 'en', 'it']);

        // Use current request path (no leading slash), normalize
        $path = trim(request()->path(), '/'); // e.g. "it/offerta" or "en/blog/12-my-post"
        $parts = $path === '' ? [] : explode('/', $path);

        // Locale detection (only if first segment is a known locale)
        $first = $parts[0] ?? null;
        $currentLocale = in_array($first, $locales, true) ? $first : (string) app()->getLocale();

        // Rest of path (without locale if locale was present)
        $rest = in_array($first, $locales, true) ? array_slice($parts, 1) : $parts;

        $pageKey = self::detectPageKey($currentLocale, $rest);

        $query = request()->getQueryString();
        $fragment = self::extractFragmentFromReferer(); // best-effort for #hash navigation

        $links = [];
        foreach ($locales as $loc) {
            $url = self::buildUrlFor($loc, $pageKey, $rest);

            if ($query) {
                $url .= '?' . $query;
            }
            if ($fragment) {
                $url .= '#' . $fragment;
            }

            $links[$loc] = $url;
        }

        return $links;
    }

    private static function detectPageKey(string $locale, array $rest): string
    {
        if (count($rest) === 0) {
            return 'home';
        }

        // Fixed slugs
        if ($rest[0] === 'blog') {
            return 'blog';
        }
        if ($rest[0] === 'faq') {
            return 'faq';
        }

        // Localized slugs from translations
        $about   = (string) trans('routes.about', [], $locale);
        $offer   = (string) trans('routes.offer', [], $locale);
        $reviews = (string) trans('routes.reviews', [], $locale);
        $contact = (string) trans('routes.contact', [], $locale);

        if ($rest[0] === $about) {
            return 'about';
        }
        if ($rest[0] === $offer) {
            return 'offer';
        }
        if ($rest[0] === $reviews) {
            return 'reviews';
        }
        if ($rest[0] === $contact) {
            return 'contact';
        }

        return 'home';
    }

    private static function buildUrlFor(string $targetLocale, string $pageKey, array $rest): string
    {
        // BLOG (index/show with id-slug)
        if ($pageKey === 'blog') {
            // $rest: ["blog"] or ["blog", "{id}-{slug}"]
            if (count($rest) >= 2) {
                $second = (string) $rest[1];

                // Extract numeric id from "{id}-{slug}" safely
                $idPart = explode('-', $second, 2)[0];
                $id = ctype_digit($idPart) ? $idPart : null;

                if ($id !== null) {
                    $targetPosts = trans('blog.posts', [], $targetLocale);

                    // blog.posts should be an array of posts with keys: id, slug (at minimum)
                    if (is_array($targetPosts)) {
                        $target = Arr::first($targetPosts, fn ($p) => (string) ($p['id'] ?? '') === (string) $id);

                        if (is_array($target) && !empty($target['slug'])) {
                            return url("/{$targetLocale}/blog/{$id}-{$target['slug']}");
                        }
                    }
                }

                // Fallback to blog index if no match
                return url("/{$targetLocale}/blog");
            }

            return url("/{$targetLocale}/blog");
        }

        // FAQ (fixed slug)
        if ($pageKey === 'faq') {
            return url("/{$targetLocale}/faq");
        }

        // Localized pages
        if (in_array($pageKey, ['about', 'offer', 'reviews', 'contact'], true)) {
            $slug = (string) trans("routes.{$pageKey}", [], $targetLocale);
            $slug = trim($slug, '/');

            return $slug !== ''
                ? url("/{$targetLocale}/{$slug}")
                : url("/{$targetLocale}");
        }

        // HOME fallback
        return url("/{$targetLocale}");
    }

    /**
     * Best-effort fragment preservation:
     * - Browsers do not send #hash to the server.
     * - We can only preserve it if user came from a page on the same site and referer contains it.
     */
    private static function extractFragmentFromReferer(): ?string
    {
        $ref = (string) request()->headers->get('referer', '');

        if ($ref === '' || !Str::contains($ref, '#')) {
            return null;
        }

        $fragment = parse_url($ref, PHP_URL_FRAGMENT);

        return is_string($fragment) && $fragment !== '' ? $fragment : null;
    }
}