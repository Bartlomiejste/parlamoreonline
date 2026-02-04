<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

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
            'home'    => fn ($l) => "/{$l}",
            'about'   => fn ($l) => "/{$l}/" . trans('routes.about', [], $l),
            'offer'   => fn ($l) => "/{$l}/" . trans('routes.offer', [], $l),
            'faq'     => fn ($l) => "/{$l}/faq",
            'reviews' => fn ($l) => "/{$l}/" . trans('routes.reviews', [], $l),
            'contact' => fn ($l) => "/{$l}/" . trans('routes.contact', [], $l),
            'blog'    => fn ($l) => "/{$l}/blog",
        ];
        
        $urls = [];

        foreach ($pages as $key => $resolver) {
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

        return response()
            ->view('seo.sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}