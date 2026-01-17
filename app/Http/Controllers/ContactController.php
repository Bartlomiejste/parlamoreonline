<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;

class ContactController extends Controller
{
    public function send(Request $request, string $locale)
    {
        $data = $request->validate([
            'name' => ['required','string','max:120'],
            'email' => ['required','email','max:180'],
            'language' => ['nullable','in:pl,en,it'],
            'level' => ['nullable','string','max:60'],
            'goal' => ['nullable','string','max:120'],
            'availability' => ['nullable','string','max:200'],
            'message' => ['required','string','max:2000'],
            'website' => ['nullable','string','max:0'], // honeypot (musi zostać puste)
        ]);

        Mail::to(config('seo.email_to'))->send(new ContactMessage($data));

        return back()->with('ok', __("contact.sent_ok"));
    }
}