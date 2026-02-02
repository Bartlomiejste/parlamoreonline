@php
    $brand = config('seo.brand', 'Parlamore Online');

    $sameAs = array_values(
        array_filter([
            config('seo.social.instagram'),
            config('seo.social.facebook'),
            config('seo.social.tiktok'),
            config('seo.social.youtube'),
            config('seo.social.linkedin'),
        ]),
    );

    $org = [
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        '@id' => url('/#organization'),
        'name' => $brand,
        'url' => url('/'),
        'logo' => asset('assets/logo.png'),
    ];

    if (!empty($sameAs)) {
        $org['sameAs'] = $sameAs;
    }

    $site = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        '@id' => url('/#website'),
        'name' => $brand,
        'url' => url('/'),
        'inLanguage' => app()->getLocale(),
        'publisher' => [
            '@id' => url('/#organization'),
        ],
        'potentialAction' => [
            '@type' => 'SearchAction',
            'target' => url('/' . app()->getLocale() . '/blog?q={search_term_string}'),
            'query-input' => 'required name=search_term_string',
        ],
    ];
@endphp

<script type="application/ld+json">
{!! json_encode($org, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

<script type="application/ld+json">
{!! json_encode($site, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
