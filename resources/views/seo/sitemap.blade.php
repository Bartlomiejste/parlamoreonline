{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($urls as $u)
        @php
            $loc = is_array($u) ? $u['loc'] ?? null : $u;
            $lastmod = $u['lastmod'] ?? null;
            $changefreq = $u['changefreq'] ?? 'weekly';
            $priority = $u['priority'] ?? '0.7';

            if (!$loc) {
                continue;
            }

            // wymuś absolute URL
            $loc = str_starts_with($loc, 'http') ? $loc : url($loc);
        @endphp
        <url>
            <loc>{{ $loc }}</loc>
            @if ($lastmod)
                <lastmod>{{ $lastmod }}</lastmod>
            @endif
            <changefreq>{{ $changefreq }}</changefreq>
            <priority>{{ $priority }}</priority>
        </url>
    @endforeach
</urlset>
