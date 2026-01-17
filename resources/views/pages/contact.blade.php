@extends('layouts.app')

@section('content')
    <section class="bg-bg">
        <div class="max-w-5xl mx-auto px-4 py-16 grid md:grid-cols-2 gap-10">
            <div>
                <h1 class="font-title text-4xl">{{ __('contact.h1') }}</h1>
                <p class="mt-5 text-lg text-ink/80">{{ __('contact.lead') }}</p>

                <div class="mt-8 rounded-2xl bg-snow border border-stone/30 p-6">
                    <div class="font-semibold">{{ __('contact.box_title') }}</div>
                    <ul class="mt-4 grid gap-3 text-ink/80">
                        @foreach (__('contact.box_bullets') as $b)
                            <li class="flex items-start gap-3">
                                <span class="mt-2 h-3 w-3 rounded-full bg-accent"></span>
                                <span>{{ $b }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="rounded-[2rem] bg-snow border border-stone/30 p-8 shadow">
                @if (session('ok'))
                    <div class="mb-4 rounded-xl bg-mint/20 border border-mint/40 p-4 font-semibold">
                        {{ session('ok') }}
                    </div>
                @endif

                <form method="post" action="{{ route('contact.send', ['locale' => app()->getLocale()]) }}"
                    class="grid gap-4">
                    @csrf

                    {{-- honeypot --}}
                    <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off">

                    <div>
                        <label class="font-semibold">{{ __('contact.form.name') }}</label>
                        <input name="name" value="{{ old('name') }}" required
                            class="mt-2 w-full rounded-xl border border-stone/30 px-4 py-3 bg-bg">
                        @error('name')
                            <div class="text-sm text-accent mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="font-semibold">{{ __('contact.form.email') }}</label>
                        <input name="email" type="email" value="{{ old('email') }}" required
                            class="mt-2 w-full rounded-xl border border-stone/30 px-4 py-3 bg-bg">
                        @error('email')
                            <div class="text-sm text-accent mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="font-semibold">{{ __('contact.form.language') }}</label>
                            <select name="language" class="mt-2 w-full rounded-xl border border-stone/30 px-4 py-3 bg-bg">
                                <option value="">{{ __('contact.form.choose') }}</option>
                                <option value="pl" @selected(old('language') === 'pl')>PL</option>
                                <option value="en" @selected(old('language') === 'en')>EN</option>
                                <option value="it" @selected(old('language') === 'it')>IT</option>
                            </select>
                        </div>

                        <div>
                            <label class="font-semibold">{{ __('contact.form.level') }}</label>
                            <input name="level" value="{{ old('level') }}"
                                placeholder="{{ __('contact.form.level_ph') }}"
                                class="mt-2 w-full rounded-xl border border-stone/30 px-4 py-3 bg-bg">
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="font-semibold">{{ __('contact.form.goal') }}</label>
                            <input name="goal" value="{{ old('goal') }}"
                                placeholder="{{ __('contact.form.goal_ph') }}"
                                class="mt-2 w-full rounded-xl border border-stone/30 px-4 py-3 bg-bg">
                        </div>

                        <div>
                            <label class="font-semibold">{{ __('contact.form.availability') }}</label>
                            <input name="availability" value="{{ old('availability') }}"
                                placeholder="{{ __('contact.form.availability_ph') }}"
                                class="mt-2 w-full rounded-xl border border-stone/30 px-4 py-3 bg-bg">
                        </div>
                    </div>

                    <div>
                        <label class="font-semibold">{{ __('contact.form.message') }}</label>
                        <textarea name="message" rows="6" required class="mt-2 w-full rounded-xl border border-stone/30 px-4 py-3 bg-bg">{{ old('message') }}</textarea>
                        @error('message')
                            <div class="text-sm text-accent mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="mt-2 px-5 py-3 rounded-2xl bg-accent text-white font-semibold shadow hover:opacity-95">
                        {{ __('contact.form.send') }}
                    </button>

                    <p class="text-sm text-ink/60">
                        {{ __('contact.form.privacy') }}
                    </p>
                </form>
            </div>
        </div>
    </section>
@endsection
