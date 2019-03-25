<?php

namespace App\Mail;

use App\Domain\BetaUser;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BetaInvite extends Mailable
{
    use Queueable, SerializesModels;

    /*
     * @var BetaUser
     */
    public $betaUser;

    public function __construct(BetaUser $betaUser)
    {
        $this->betaUser = $betaUser;
    }

    public function build()
    {
        return $this
	        ->subject("Your Fynches Invitation")
	        ->view('emails.beta-invite');
    }
}
