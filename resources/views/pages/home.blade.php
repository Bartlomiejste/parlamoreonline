@extends('layouts.app')

@section('content')
    @include('sections.hero')
    @include('sections.offer-teaser')
    @include('sections.how-it-works')
    @include('sections.for-who')
    {{-- @include('sections.reviews-teaser') --}}
    @include('sections.faq-teaser')
    @include('sections.contact-teaser')
@endsection
