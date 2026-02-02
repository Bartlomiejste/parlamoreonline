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
            ->subject(__('emails.contact.subject'))
            ->replyTo($this->data['email'] ?? config('mail.from.address'))
            ->view('emails.contact')
            ->with([
                'd' => $this->data,
            ]);
    }
}