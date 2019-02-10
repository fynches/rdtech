<?php

namespace App\Mail;

use App\Domain\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentCreated extends Mailable
{
    use Queueable, SerializesModels;

    /*
     * @var Payment
     */
    public $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    public function build()
    {
        return $this
	        ->subject("Thank you for sending a gift through Fynches")
	        ->view('emails.payment-created');
    }
}
