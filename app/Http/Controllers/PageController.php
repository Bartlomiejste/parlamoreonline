<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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
        App::setLocale($locale);

        $title = (string) __("seo.$page.title");
        $desc  = (string) __("seo.$page.description");

        $canonical = url()->current();

        $alternates = [];
        foreach (config('seo.locales', ['pl', 'en', 'it']) as $loc) {
            $alternates[$loc] = $this->localizedUrl($loc, $page);
        }

        return compact('title', 'desc', 'canonical', 'alternates', 'page');
    }

    private function localizedUrl(string $locale, string $page): string
    {
        
        if ($page === 'home') {
            return url("/{$locale}");
        }

        if ($page === 'faq') {
            return url("/{$locale}/faq");
        }

        if ($page === 'blog') {
            return url("/{$locale}/blog");
        }

        if (in_array($page, ['about', 'offer', 'reviews', 'contact'], true)) {
            $slug = trim((string) trans("routes.{$page}", [], $locale), '/');
            return $slug !== '' ? url("/{$locale}/{$slug}") : url("/{$locale}");
        }


        return url("/{$locale}");
    }
}