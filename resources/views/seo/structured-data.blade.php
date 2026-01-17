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
        'name' => $brand,
        'url' => url('/'),
        'logo' => asset('/assets/logo.png'),
    ];

    if (!empty($sameAs)) {
        $org['sameAs'] = $sameAs;
    }

    $site = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => $brand,
        'url' => url('/'),
        'inLanguage' => app()->getLocale(),
    ];
@endphp

<script type="application/ld+json">{!! json_encode($org, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
<script type="application/ld+json">{!! json_encode($site, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
