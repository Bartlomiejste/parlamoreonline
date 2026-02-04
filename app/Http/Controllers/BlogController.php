<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;

class BlogController extends Controller
{
    public function index(Request $request, string $locale)
    {
        App::setLocale($locale);
        app('translator')->setLocale($locale);

        $posts = $this->posts($locale);

        $title = (string) __('seo.blog.title');
        $desc  = (string) __('seo.blog.description');
        $canonical = url()->current();

        $alternates = [];
        foreach (config('seo.locales', ['pl', 'en', 'it']) as $loc) {
            $alternates[$loc] = url("/{$loc}/blog");
        }

        return view('blog.index', compact('posts', 'title', 'desc', 'canonical', 'alternates'));
    }

    public function show(Request $request, string $locale, string $id, ?string $slug = null)
    {
        App::setLocale($locale);
        app('translator')->setLocale($locale);

        $posts = $this->posts($locale);
        $post = Arr::first($posts, fn ($p) => (string) ($p['id'] ?? '') === (string) $id);

        abort_if(!$post, 404);

        $correctSlug = (string) ($post['slug'] ?? '');
        if ($correctSlug !== '' && $slug !== null && $slug !== $correctSlug) {
            return redirect()->to(url("/{$locale}/blog/{$id}-{$correctSlug}"), 301);
        }

        $title = (string) ($post['meta_title'] ?? $post['title'] ?? __('seo.blog.post_fallback_title'));
        $desc  = (string) ($post['meta_description'] ?? $post['excerpt'] ?? '');
        $canonical = $correctSlug !== ''
            ? url("/{$locale}/blog/{$id}-{$correctSlug}")
            : url("/{$locale}/blog");

        $alternates = [];
        foreach (config('seo.locales', ['pl', 'en', 'it']) as $loc) {
            $targetPosts = $this->posts($loc);
            $target = Arr::first($targetPosts, fn ($p) => (string) ($p['id'] ?? '') === (string) $id);

            $alternates[$loc] = (is_array($target) && !empty($target['slug']))
                ? url("/{$loc}/blog/{$id}-{$target['slug']}")
                : url("/{$loc}/blog");
        }

        return view('blog.show', compact('post', 'title', 'desc', 'canonical', 'alternates'));
    }

    private function posts(string $locale): array
    {
        $posts = trans('blog.posts', [], $locale);

        return is_array($posts) ? $posts : [];
    }
}