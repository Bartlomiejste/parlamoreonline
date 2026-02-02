<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Support\Str;

class SchemaBuilder
{
    public static function breadcrumbs(string $pageType, array $data = []): array
    {
        $loc = (string) app()->getLocale();

        $homeName = (string) __('nav.home');
        $blogName = (string) __('nav.blog');

        $items = [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => $homeName,
                'item' => url("/{$loc}"),
            ],
        ];

        if ($pageType === 'blog_index') {
            $items[] = [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => $blogName,
                'item' => url("/{$loc}/blog"),
            ];
        } elseif ($pageType === 'blog_post') {
            $items[] = [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => $blogName,
                'item' => url("/{$loc}/blog"),
            ];

            $items[] = [
                '@type' => 'ListItem',
                'position' => 3,
                'name' => (string) ($data['title'] ?? 'Post'),
                'item' => (string) ($data['url'] ?? url()->current()),
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $items,
        ];
    }

    public static function blogPosting(array $post, string $canonicalUrl): array
    {
        $brand = (string) config('seo.brand');
        $siteUrl = url('/'); // homepage/root

        // Prefer Person if you have it configured; otherwise Organization
        $authorName = (string) ($post['author_name'] ?? config('seo.author_name', ''));
        $author = $authorName !== ''
            ? [
                '@type' => 'Person',
                'name' => $authorName,
            ]
            : [
                '@type' => 'Organization',
                'name' => $brand,
                'url' => $siteUrl,
            ];

        // Use ISO dates if available; fallback to date (if already ISO)
        $published = self::normalizeDate((string) ($post['date_iso'] ?? $post['date'] ?? ''));
        $modified  = self::normalizeDate((string) ($post['modified_iso'] ?? $post['date_iso'] ?? $post['modified'] ?? $post['date'] ?? ''));

        // Pick best description
        $description = (string) ($post['meta_description'] ?? $post['excerpt'] ?? '');

        // Headline should be <=110 chars ideally; we won’t cut hard, just keep as provided
        $headline = (string) ($post['title'] ?? $brand);

        // Images: allow per-post image; fallback to default OG
        $imageUrl = (string) ($post['image'] ?? $post['image_url'] ?? '');
        if ($imageUrl === '') {
            $imageUrl = asset((string) config('seo.default_images.og'));
        } elseif (!Str::startsWith($imageUrl, ['http://', 'https://'])) {
            $imageUrl = asset(ltrim($imageUrl, '/'));
        }

        // Keywords: optional
        $keywords = $post['keywords'] ?? $post['meta_keywords'] ?? null;

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => $canonicalUrl,
            ],
            'url' => $canonicalUrl,
            'headline' => $headline,
            'description' => $description,
            'inLanguage' => (string) app()->getLocale(),
            'publisher' => [
                '@type' => 'Organization',
                'name' => $brand,
                'url' => $siteUrl,
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('/assets/logo.png'),
                ],
            ],
            'author' => $author,
            'image' => [
                $imageUrl,
            ],
        ];

        if ($published !== null) {
            $schema['datePublished'] = $published;
        }
        if ($modified !== null) {
            $schema['dateModified'] = $modified;
        } elseif ($published !== null) {
            // If we only have published, mirror it for modified (common and valid)
            $schema['dateModified'] = $published;
        }

        if (is_array($keywords) && !empty($keywords)) {
            $schema['keywords'] = array_values(array_filter($keywords, fn ($k) => is_string($k) && trim($k) !== ''));
        } elseif (is_string($keywords) && trim($keywords) !== '') {
            $schema['keywords'] = $keywords;
        }

        // Optionally include wordCount if you have content as array of paragraphs
        if (!empty($post['content']) && is_array($post['content'])) {
            $text = trim(implode(' ', array_map('strip_tags', $post['content'])));
            if ($text !== '') {
                $schema['wordCount'] = str_word_count($text);
            }
        }

        return $schema;
    }

    private static function normalizeDate(string $value): ?string
    {
        $value = trim($value);
        if ($value === '') {
            return null;
        }

        // Accept ISO date (YYYY-MM-DD) or ISO datetime. If not ISO-ish, skip.
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)) {
            return $value;
        }

        // If you ever store full ISO datetime like 2026-02-02T10:00:00+01:00
        if (preg_match('/^\d{4}-\d{2}-\d{2}T/', $value)) {
            return $value;
        }

        return null;
    }
}