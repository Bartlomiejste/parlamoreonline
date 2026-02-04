<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use SimpleXMLElement;

class SeoController extends Controller
{
    public function robots(): Response
    {
        $content = implode("\n", [
            'User-agent: *',
            'Allow: /',
            'Sitemap: ' . url('/sitemap.xml'),
            '',
        ]);

        return response($content, 200)
            ->header('Content-Type', 'text/plain; charset=UTF-8');
    }

    public function sitemap(): Response
    {
        $locales = config('seo.locales', ['pl', 'en', 'it']);
        $lastmod = Carbon::now()->toDateString();

        $pages = [
            'home'    => fn (string $l) => "/{$l}",
            'about'   => fn (string $l) => "/{$l}/" . trans('routes.about', [], $l),
            'offer'   => fn (string $l) => "/{$l}/" . trans('routes.offer', [], $l),
            'faq'     => fn (string $l) => "/{$l}/faq",
            'reviews' => fn (string $l) => "/{$l}/" . trans('routes.reviews', [], $l),
            'contact' => fn (string $l) => "/{$l}/" . trans('routes.contact', [], $l),
            'blog'    => fn (string $l) => "/{$l}/blog",
        ];

        $urls = [];

        foreach ($pages as $resolver) {
            $cluster = [];

            foreach ($locales as $loc) {
                $cluster[$loc] = url($resolver($loc));
            }

            $urls[] = [
                'loc'        => $cluster['pl'] ?? reset($cluster),
                'lastmod'    => $lastmod,
                'alternates' => $cluster,
            ];
        }

        $NS = 'http://www.sitemaps.org/schemas/sitemap/0.9';
        $XHTML = 'http://www.w3.org/1999/xhtml';

        $xml = new SimpleXMLElement(
            '<?xml version="1.0" encoding="UTF-8"?>' .
'<urlset xmlns="' . $NS . '" xmlns:xhtml="' . $XHTML . '"></urlset>'
);

foreach ($urls as $u) {
$url = $xml->addChild('url', null, $NS);
$url->addChild('loc', $u['loc'], $NS);
$url->addChild('lastmod', $u['lastmod'], $NS);

foreach (($u['alternates'] ?? []) as $lang => $href) {
$link = $url->addChild('link', null, $XHTML);
$link->addAttribute('rel', 'alternate');
$link->addAttribute('hreflang', (string) $lang);
$link->addAttribute('href', (string) $href);
}

$default = $u['alternates']['pl'] ?? $u['loc'];
$xdef = $url->addChild('link', null, $XHTML);
$xdef->addAttribute('rel', 'alternate');
$xdef->addAttribute('hreflang', 'x-default');
$xdef->addAttribute('href', (string) $default);
}

$out = $xml->asXML() ?: '';

return response($out, 200)
->header('Content-Type', 'application/xml; charset=UTF-8')
->header('Content-Disposition', 'inline; filename="sitemap.xml"')
->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
->header('Pragma', 'no-cache')
->header('X-Content-Type-Options', 'nosniff');
}
}