<?php

namespace App\Mail;

use App\Domain\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserCreated extends Mailable
{
    use Queueable, SerializesModels;

    /*
     * @var User
     */
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this
	        ->subject("Welcome To Fynches, The Gift Registry for Modern Parents!")
	        ->view('emails.user-created');
    }
}
