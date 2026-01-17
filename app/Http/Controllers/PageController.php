<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(Request $request, string $locale)
    {
        return view('pages.home', $this->sharedSeo($locale, 'home'));
    }

    public function about(Request $request, string $locale)
    {
        return view('pages.about', $this->sharedSeo($locale, 'about'));
    }

    public function offer(Request $request, string $locale)
    {
        return view('pages.offer', $this->sharedSeo($locale, 'offer'));
    }

    public function faq(Request $request, string $locale)
    {
        return view('pages.faq', $this->sharedSeo($locale, 'faq'));
    }

    public function reviews(Request $request, string $locale)
    {
        return view('pages.reviews', $this->sharedSeo($locale, 'reviews'));
    }

    public function contact(Request $request, string $locale)
    {
        return view('pages.contact', $this->sharedSeo($locale, 'contact'));
    }

    private function sharedSeo(string $locale, string $page): array
    {
        $title = __("seo.$page.title");
        $desc  = __("seo.$page.description");

        // canonical = aktualny url (bez query)
        $canonical = url()->current();

        // alternate hreflang links
        $alternates = [];
        foreach (config('seo.locales') as $loc) {
            $alternates[$loc] = $this->localizedUrl($loc, $page);
        }

        return compact('title', 'desc', 'canonical', 'alternates', 'page');
    }

    private function localizedUrl(string $locale, string $page): string
    {
        // map page => localized path
        $map = [
            'home'    => '',
            'about'   => $locale === 'pl' ? 'o-mnie' : ($locale === 'en' ? 'about' : 'chi-sono'),
            'offer'   => $locale === 'pl' ? 'oferta' : ($locale === 'en' ? 'offer' : 'offerta'),
            'faq'     => 'faq',
            'reviews' => $locale === 'pl' ? 'opinie' : ($locale === 'en' ? 'reviews' : 'recensioni'),
            'contact' => $locale === 'pl' ? 'kontakt' : ($locale === 'en' ? 'contact' : 'contatto'),
            'blog'    => 'blog',
        ];

        $path = $map[$page] ?? '';
        return url("/{$locale}" . ($path !== '' ? "/{$path}" : ""));
    }
}