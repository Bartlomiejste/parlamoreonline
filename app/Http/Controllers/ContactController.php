<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Mail\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request, string $locale)
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:120'],
            'email'       => ['required', 'email', 'max:180'],
            'course_type' => ['nullable', 'in:individual,pair,group'],
            'message'     => ['required', 'string', 'max:2000'],

            'website'     => ['nullable', 'string', 'max:0'],
        ]);

        Mail::to(config('seo.email_to'))->send(new ContactMessage($data));

        return back()->with('ok', __('contact.sent_ok'));
    }
}