<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SeoController;

Route::get('/robots.txt', [SeoController::class, 'robots']);
Route::get('/sitemap.xml', [SeoController::class, 'sitemap']);

Route::redirect('/', '/pl', 301);

Route::group([
    'prefix' => '{locale}',
    'where' => ['locale' => 'pl|en|it'],
    'middleware' => ['setlocale'],
], function () {

    // Home (one-page)
    Route::get('/', [PageController::class, 'home'])->name('home');

    // Podstrony (SEO-friendly)
    Route::get('/o-mnie', [PageController::class, 'about'])->name('about')->whereIn('locale', ['pl']);
    Route::get('/about', [PageController::class, 'about'])->name('about_en')->whereIn('locale', ['en']);
    Route::get('/chi-sono', [PageController::class, 'about'])->name('about_it')->whereIn('locale', ['it']);

    Route::get('/oferta', [PageController::class, 'offer'])->name('offer')->whereIn('locale', ['pl']);
    Route::get('/offer', [PageController::class, 'offer'])->name('offer_en')->whereIn('locale', ['en']);
    Route::get('/offerta', [PageController::class, 'offer'])->name('offer_it')->whereIn('locale', ['it']);

    Route::get('/faq', [PageController::class, 'faq'])->name('faq');

    Route::get('/opinie', [PageController::class, 'reviews'])->name('reviews')->whereIn('locale', ['pl']);
    Route::get('/reviews', [PageController::class, 'reviews'])->name('reviews_en')->whereIn('locale', ['en']);
    Route::get('/recensioni', [PageController::class, 'reviews'])->name('reviews_it')->whereIn('locale', ['it']);

    Route::get('/kontakt', [PageController::class, 'contact'])->name('contact')->whereIn('locale', ['pl']);
    Route::get('/contact', [PageController::class, 'contact'])->name('contact_en')->whereIn('locale', ['en']);
    Route::get('/contatto', [PageController::class, 'contact'])->name('contact_it')->whereIn('locale', ['it']);

    // Blog (opcjonalny, ale włączony)
    Route::get('/blog', [BlogController::class, 'index'])->name('blog');
    Route::get('/blog/{id}-{slug?}', [BlogController::class, 'show'])->name('blog.show');

    // Formularz kontaktowy
    Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
});