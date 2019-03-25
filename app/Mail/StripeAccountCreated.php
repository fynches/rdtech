<?php

namespace App\Mail;

use App\Domain\StripeAccount;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StripeAccountCreated extends Mailable
{
    use Queueable, SerializesModels;

    /*
     * @var StripeAccount
     */
    public $stripeAccount;

    public function __construct(StripeAccount $stripeAccount)
    {
        $this->stripeAccount = $stripeAccount;
    }

    public function build()
    {
        return $this
	        ->subject("Bank Connected. You Can Know Receive Funds.")
	        ->view('emails.stripe-account-created');
    }
}
