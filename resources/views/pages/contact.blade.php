@extends('layouts.app')

@php
    $loc = request()->route('locale') ?? app()->getLocale();
@endphp

@section('content')
    <section class="bg-bg" aria-labelledby="contact-title">
        <div class="max-w-6xl mx-auto px-4 py-16 grid md:grid-cols-2 gap-12">

            {{-- LEWA KOLUMNA --}}
            <div>
                <h1 id="contact-title" class="font-title text-4xl font-bold">
                    {{ __('contact.h1') }}
                </h1>

                <p class="mt-5 text-lg text-ink/80">
                    {{ __('contact.lead') }}
                </p>

                <p class="mt-6 text-ink/80">
                    {{ __('contact.left_text') }}
                </p>

                {{-- SOCIAL --}}
                <nav class="mt-8" aria-label="Social media">
                    <div class="flex items-center gap-5">

                        <a href="https://www.facebook.com/profile.php?id=61586056376364" target="_blank"
                            rel="noopener noreferrer">
                            <img src="{{ asset('assets/footer/facebook.png') }}" alt="Facebook" class="h-8 w-8"
                                loading="lazy">
                        </a>

                        <a href="https://www.instagram.com/parlamore_online" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('assets/footer/instagram.png') }}" alt="Instagram" class="h-8 w-8"
                                loading="lazy">
                        </a>

                        <a href="mailto:{{ config('mail.from.address') }}">
                            <img src="{{ asset('assets/footer/gmail.png') }}" alt="E-mail" class="h-8 w-8" loading="lazy">
                        </a>

                    </div>
                </nav>

                {{-- PODPOWIEDŹ --}}
                <div class="mt-8 rounded-2xl bg-snow border border-stone/30 p-6">
                    <div class="font-semibold">
                        {{ __('contact.box_title') }}
                    </div>

                    <ul class="mt-4 grid gap-3 text-ink/80">
                        @foreach (__('contact.box_bullets') as $bullet)
                            <li class="flex items-start gap-3">
                                <span class="mt-2 h-3 w-3 rounded-full bg-accent"></span>
                                <span>{{ $bullet }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- PRAWA KOLUMNA – FORMULARZ --}}
            <div class="rounded-[2rem] bg-snow border border-stone/30 p-8 shadow">

                {{-- SUCCESS --}}
                @if (session('ok'))
                    <div class="mb-4 rounded-xl bg-mint/20 border border-mint/40 p-4 font-semibold">
                        {{ session('ok') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.send', ['locale' => $loc]) }}" class="grid gap-4"
                    novalidate>

                    @csrf

                    {{-- HONEYPOT --}}
                    <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off">

                    {{-- IMIĘ --}}
                    <div>
                        <label for="contact-name" class="font-semibold">
                            {{ __('contact.form.name') }}
                        </label>
                        <input id="contact-name" name="name" value="{{ old('name') }}" required autocomplete="name"
                            class="mt-2 w-full rounded-xl border border-stone/30 px-4 py-3 bg-bg">
                    </div>

                    {{-- EMAIL --}}
                    <div>
                        <label for="contact-email" class="font-semibold">
                            {{ __('contact.form.email') }}
                        </label>
                        <input id="contact-email" name="email" type="email" value="{{ old('email') }}" required
                            autocomplete="email" class="mt-2 w-full rounded-xl border border-stone/30 px-4 py-3 bg-bg">
                    </div>

                    {{-- TYP KURSU --}}
                    <div>
                        <label for="contact-course-type" class="font-semibold">
                            {{ __('contact.form.course_type') }}
                        </label>
                        <select id="contact-course-type" name="course_type"
                            class="mt-2 w-full rounded-xl border border-stone/30 px-4 py-3 bg-bg">

                            <option value="">
                                {{ __('contact.form.choose') }}
                            </option>

                            <option value="individual" @selected(old('course_type') === 'individual')>
                                {{ __('contact.form.course_individual') }}
                            </option>

                            <option value="pair" @selected(old('course_type') === 'pair')>
                                {{ __('contact.form.course_pair') }}
                            </option>

                            <option value="group" @selected(old('course_type') === 'group')>
                                {{ __('contact.form.course_group') }}
                            </option>
                        </select>
                    </div>

                    {{-- WIADOMOŚĆ --}}
                    <div>
                        <label for="contact-message" class="font-semibold">
                            {{ __('contact.form.message') }}
                        </label>
                        <textarea id="contact-message" name="message" rows="6" required
                            class="mt-2 w-full rounded-xl border border-stone/30 px-4 py-3 bg-bg">{{ old('message') }}</textarea>
                    </div>

                    {{-- SUBMIT --}}
                    <button type="submit"
                        class="mt-2 px-6 py-3 rounded-2xl bg-accent text-white font-semibold shadow hover:opacity-95">
                        {{ __('contact.form.send') }}
                    </button>

                    <p class="text-sm text-center text-ink/60">
                        {{ __('contact.form.privacy') }}
                    </p>

                </form>
            </div>

        </div>
    </section>
@endsection
