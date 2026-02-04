@php
    $loc = request()->route('locale') ?? app()->getLocale();
@endphp

@php

    $brand = config('seo.brand', 'Parlamoreonline');

    $image = $post['image'] ?? asset('assets/logo.png');

    $desc = $post['excerpt'] ?? ($post['meta_desc'] ?? null);

    $data = [
        '@context' => 'https://schema.org',
        '@type' => 'BlogPosting',

        'headline' => $post['title'] ?? $brand,
        'description' => $desc,

        'datePublished' => $post['date_iso'] ?? null,
        'dateModified' => $post['updated_iso'] ?? ($post['date_iso'] ?? null),

        'inLanguage' => $loc,

        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id' => url()->current(),
        ],

        'image' => [$image],

        'author' => [
            '@type' => 'Person',
            'name' => config('seo.author', $brand),
        ],

        'publisher' => [
            '@type' => 'Organization',
            'name' => $brand,
            'logo' => [
                '@type' => 'ImageObject',
                'url' => asset('assets/logo.png'),
            ],
        ],

        'isPartOf' => [
            '@type' => 'Blog',
            'name' => $brand . ' Blog',
            'url' => url('/' . $loc . '/blog'),
        ],
    ];

    $data = array_filter($data, fn($v) => !is_null($v) && $v !== '');
@endphp

@if (!empty($post))
    <script type="application/ld+json">
{!! json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endif
