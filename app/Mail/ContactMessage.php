<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function build(): self
    {
        return $this
            ->subject(__('contact.contact.subject'))
            ->replyTo($this->data['email'] ?? config('mail.from.address'), $this->data['name'] ?? null)
            ->view('emails.contact')
            ->with([
                'd' => $this->data,
            ]);
    }
}