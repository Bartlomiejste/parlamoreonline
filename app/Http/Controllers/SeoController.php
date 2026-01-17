<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function robots(): Response
    {
        $content = "User-agent: *\n";
        $content .= "Allow: /\n";
        $content .= "Sitemap: " . url('/sitemap.xml') . "\n";

        return response($content, 200)->header('Content-Type', 'text/plain; charset=UTF-8');
    }

    public function sitemap(): Response
    {
        $urls = [];

        foreach (config('seo.locales') as $loc) {
            $urls[] = url("/{$loc}");
            $urls[] = url("/{$loc}/" . ($loc === 'pl' ? 'o-mnie' : ($loc === 'en' ? 'about' : 'chi-sono')));
            $urls[] = url("/{$loc}/" . ($loc === 'pl' ? 'oferta' : ($loc === 'en' ? 'offer' : 'offerta')));
            $urls[] = url("/{$loc}/faq");
            $urls[] = url("/{$loc}/" . ($loc === 'pl' ? 'opinie' : ($loc === 'en' ? 'reviews' : 'recensioni')));
            $urls[] = url("/{$loc}/" . ($loc === 'pl' ? 'kontakt' : ($loc === 'en' ? 'contact' : 'contatto')));
            $urls[] = url("/{$loc}/blog");
        }

        $xml = view('seo.sitemap', ['urls' => $urls])->render();

        return response($xml, 200)->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}