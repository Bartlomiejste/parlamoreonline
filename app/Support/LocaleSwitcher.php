<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class LocaleSwitcher
{
    public static function links(): array
    {
        $locales = config('seo.locales', ['pl', 'en', 'it']);

        $path = trim(request()->path(), '/'); // np. "pl/oferta" albo "en/blog/1-slug"
        $parts = $path === '' ? [] : explode('/', $path);

        $first = $parts[0] ?? null;
        $currentLocale = in_array($first, $locales, true) ? $first : (string) app()->getLocale();
        $rest = in_array($first, $locales, true) ? array_slice($parts, 1) : $parts;

        $pageKey = self::detectPageKey($currentLocale, $rest);

        $query = request()->getQueryString();

        $links = [];
        foreach ($locales as $loc) {
            $url = self::buildUrlFor($loc, $pageKey, $rest);

            if ($query) {
                $url .= '?' . $query;
            }

            $links[$loc] = $url;
        }

        return $links;
    }

    private static function detectPageKey(string $locale, array $rest): string
    {
        if (count($rest) === 0) return 'home';

        if ($rest[0] === 'blog') return 'blog';
        if ($rest[0] === 'faq')  return 'faq';

        // rozpoznanie po przetłumaczonych slugach
        $about   = trim((string) trans('routes.about', [], $locale), '/');
        $offer   = trim((string) trans('routes.offer', [], $locale), '/');
        $reviews = trim((string) trans('routes.reviews', [], $locale), '/');
        $contact = trim((string) trans('routes.contact', [], $locale), '/');

        if ($rest[0] === $about)   return 'about';
        if ($rest[0] === $offer)   return 'offer';
        if ($rest[0] === $reviews) return 'reviews';
        if ($rest[0] === $contact) return 'contact';

        return 'home';
    }

    private static function buildUrlFor(string $targetLocale, string $pageKey, array $rest): string
    {
        // BLOG: /{loc}/blog albo /{loc}/blog/{id}-{slug}
        if ($pageKey === 'blog') {
            if (count($rest) >= 2) {
                $second = (string) $rest[1];
                $idPart = explode('-', $second, 2)[0];
                $id = ctype_digit($idPart) ? $idPart : null;

                if ($id !== null) {
                    $targetPosts = trans('blog.posts', [], $targetLocale);
                    if (is_array($targetPosts)) {
                        $target = Arr::first($targetPosts, fn ($p) => (string) ($p['id'] ?? '') === (string) $id);
                        if (is_array($target) && !empty($target['slug'])) {
                            return url("/{$targetLocale}/blog/{$id}-{$target['slug']}");
                        }
                    }
                }
                return url("/{$targetLocale}/blog");
            }
            return url("/{$targetLocale}/blog");
        }

        if ($pageKey === 'faq') {
            return url("/{$targetLocale}/faq");
        }

        if (in_array($pageKey, ['about', 'offer', 'reviews', 'contact'], true)) {
            $slug = trim((string) trans("routes.{$pageKey}", [], $targetLocale), '/');
            return $slug !== '' ? url("/{$targetLocale}/{$slug}") : url("/{$targetLocale}");
        }

        return url("/{$targetLocale}");
    }
}