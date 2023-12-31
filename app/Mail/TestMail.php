<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable,SerializesModels;

    public function __construct()
    {
    }

    public function build(): TestMail
    {
        return $this->subject('This is a test mail.')
            ->markdown('admin.emails.test-mail');
    }
}
