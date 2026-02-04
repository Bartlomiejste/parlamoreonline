<!doctype html>
@php
    $loc = request()->route('locale') ?? app()->getLocale();
@endphp

<html lang="{{ $loc }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? config('seo.brand') }}</title>
    <meta name="description" content="{{ $desc ?? '' }}">

    <link rel="canonical" href="{{ $canonical ?? url()->current() }}">

    <meta name="robots" content="{{ $robots ?? 'index,follow,max-image-preview:large' }}">
    <meta name="theme-color" content="{{ config('seo.theme_color', '#ffffff') }}">

    {{-- hreflang --}}
    @if (!empty($alternates))
        @foreach ($alternates as $loc => $href)
            <link rel="alternate" hreflang="{{ $loc }}" href="{{ $href }}">
        @endforeach
        <link rel="alternate" hreflang="x-default" href="{{ $alternates['pl'] ?? url('/pl') }}">
    @endif

    {{-- Open Graph --}}
    <meta property="og:site_name" content="{{ config('seo.brand') }}">
    <meta property="og:title" content="{{ $title ?? config('seo.brand') }}">
    <meta property="og:description" content="{{ $desc ?? '' }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $canonical ?? url()->current() }}">
    <meta property="og:image" content="{{ asset(config('seo.default_images.og')) }}">
    <meta property="og:locale" content="{{ str_replace('-', '_', $loc) }}">


    @if (!empty($alternates))
        @foreach (array_keys($alternates) as $aLoc)
            @if ($aLoc !== $loc)
                <meta property="og:locale:alternate" content="{{ str_replace('-', '_', $aLoc) }}">
            @endif
        @endforeach
    @endif



    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ?? config('seo.brand') }}">
    <meta name="twitter:description" content="{{ $desc ?? '' }}">
    <meta name="twitter:image" content="{{ asset(config('seo.default_images.og')) }}">

    @if (config('seo.social.twitter'))
        <meta name="twitter:site" content="{{ config('seo.social.twitter') }}">
    @endif

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('/favicon.png') }}" sizes="any">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/favicon-16x16.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('/site.webmanifest') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-bg text-ink font-sans antialiased">
    <a class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 bg-snow px-3 py-2 rounded-xl shadow"
        href="#main">
        {{ __('nav.skip_to_content') }}
    </a>

    @include('partials.header')

    <main id="main" role="main">
        @yield('content')
    </main>

    @include('partials.footer')

    @include('seo.structured-data')
</body>

</html>
