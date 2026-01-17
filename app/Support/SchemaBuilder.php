<?php

namespace App\Support;

class SchemaBuilder
{
    public static function breadcrumbs(string $pageType, array $data = []): array
    {
        $loc = app()->getLocale();

        $homeName = __('nav.home');
        $blogName = __('nav.blog');

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
        }

        if ($pageType === 'blog_post') {
            $items[] = [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => $blogName,
                'item' => url("/{$loc}/blog"),
            ];

            $items[] = [
                '@type' => 'ListItem',
                'position' => 3,
                'name' => $data['title'] ?? 'Post',
                'item' => $data['url'] ?? url()->current(),
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
        $brand = config('seo.brand');
        $orgUrl = url('/');

        // Jeśli nie masz autora po imieniu, nie wymyślamy – użyj Organization
        $author = [
            '@type' => 'Organization',
            'name' => $brand,
            'url' => $orgUrl,
        ];

        // datePublished i dateModified – bierzemy z posta (YYYY-MM-DD)
        $published = $post['date'] ?? null;

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => $post['title'] ?? $brand,
            'description' => $post['meta_description'] ?? '',
            'inLanguage' => app()->getLocale(),
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => $canonicalUrl,
            ],
            'url' => $canonicalUrl,
            'publisher' => [
                '@type' => 'Organization',
                'name' => $brand,
                'url' => $orgUrl,
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('/assets/logo.png'),
                ],
            ],
            'author' => $author,
            'image' => [
                asset(config('seo.default_images.og')),
            ],
        ];

        if ($published) {
            $schema['datePublished'] = $published;
            $schema['dateModified']  = $published;
        }

        return $schema;
    }
}