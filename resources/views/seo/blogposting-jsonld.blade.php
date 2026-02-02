@php
    $brand = config('seo.brand', 'Parlamore Online');

    // Post image (jeśli masz okładkę per wpis – podstaw tu)
    $image = $post['image'] ?? asset('assets/logo.png');

    // Krótki opis (jeśli masz excerpt – podstaw)
    $desc = $post['excerpt'] ?? ($post['meta_desc'] ?? null);

    $data = [
        '@context' => 'https://schema.org',
        '@type' => 'BlogPosting',

        'headline' => $post['title'] ?? $brand,
        'description' => $desc,

        'datePublished' => $post['date_iso'] ?? null,
        'dateModified' => $post['updated_iso'] ?? ($post['date_iso'] ?? null),

        'inLanguage' => app()->getLocale(),

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

        // Fajny sygnał, że to część bloga (związek struktury)
        'isPartOf' => [
            '@type' => 'Blog',
            'name' => $brand . ' Blog',
            'url' => url('/' . app()->getLocale() . '/blog'),
        ],
    ];

    // usuń nulle i puste rzeczy
    $data = array_filter($data, fn($v) => !is_null($v) && $v !== '');
@endphp

@if (!empty($post))
    <script type="application/ld+json">
{!! json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endif
