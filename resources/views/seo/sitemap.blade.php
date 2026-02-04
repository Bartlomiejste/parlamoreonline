{!! '<' !!}?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">

    @foreach ($urls as $u)
        @php
            $loc = $u['loc'] ?? null;
            $lastmod = $u['lastmod'] ?? null;
            $changefreq = $u['changefreq'] ?? 'weekly';
            $priority = $u['priority'] ?? '0.7';
            $alternates = $u['alternates'] ?? [];

            if (!$loc) {
                continue;
            }
        @endphp

        <url>
            <loc>{{ $loc }}</loc>

            @if ($lastmod)
                <lastmod>{{ $lastmod }}</lastmod>
            @endif

            <changefreq>{{ $changefreq }}</changefreq>
            <priority>{{ $priority }}</priority>

            @foreach ($alternates as $lang => $href)
                <xhtml:link rel="alternate" hreflang="{{ $lang }}" href="{{ $href }}" />
            @endforeach

            @php
                $default = $alternates['pl'] ?? $loc;
            @endphp
            <xhtml:link rel="alternate" hreflang="x-default" href="{{ $default }}" />

        </url>
    @endforeach

</urlset>
