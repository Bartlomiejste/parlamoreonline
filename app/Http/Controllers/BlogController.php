<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request, string $locale)
    {
        $posts = $this->posts($locale);

        $title = __("seo.blog.title");
        $desc  = __("seo.blog.description");
        $canonical = url()->current();

        $alternates = [];
        foreach (config('seo.locales') as $loc) {
            $alternates[$loc] = url("/{$loc}/blog");
        }

        return view('blog.index', compact('posts', 'title', 'desc', 'canonical', 'alternates'));
    }

    public function show(Request $request, string $locale, string $id, ?string $slug = null)
    {
        $posts = $this->posts($locale);
        $post = collect($posts)->firstWhere('id', $id);

        abort_if(!$post, 404);

        // Jeśli slug w URL jest inny niż "slug" w danym języku, rób 301 na poprawny (SEO)
        $correctSlug = $post['slug'];
        if ($slug !== $correctSlug) {
            return redirect()->to(url("/{$locale}/blog/{$id}-{$correctSlug}"), 301);
        }

        $title = $post['meta_title'];
        $desc  = $post['meta_description'];
        $canonical = url("/{$locale}/blog/{$id}-{$correctSlug}");

        $alternates = [];
        foreach (config('seo.locales') as $loc) {
            $targetPosts = $this->posts($loc);
            $target = collect($targetPosts)->firstWhere('id', $id);

            // jeśli z jakiegoś powodu brak tłumaczenia wpisu w danym języku -> fallback na index bloga
            $alternates[$loc] = $target
                ? url("/{$loc}/blog/{$id}-{$target['slug']}")
                : url("/{$loc}/blog");
        }

        return view('blog.show', compact('post', 'title', 'desc', 'canonical', 'alternates'));
    }

    private function posts(string $locale): array
    {
        return __("blog.posts");
    }
}