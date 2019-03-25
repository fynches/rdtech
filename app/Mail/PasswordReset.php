<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;

class PasswordReset extends Mailable
{
    use Queueable;

    public $link;

    public function __construct($link)
    {
        $this->link = $link;
    }

    public function build()
    {
        return $this
	        ->subject("Fynches Password Reset Request")
	        ->view('emails.reset');
    }
}
