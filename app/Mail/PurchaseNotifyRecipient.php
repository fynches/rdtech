<?php

namespace App\Mail;

use App\Domain\Purchase;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PurchaseNotifyRecipient extends Mailable
{
    use Queueable, SerializesModels;

    /*
     * @var Purchase
     */
    public $purchase;

    public function __construct(Purchase $purchase)
    {
        $this->purchase = $purchase;
    }

    public function build()
    {
        return $this
	        ->subject("You have a new gift!")
	        ->view('emails.purchase-notify-recipient');
    }
}
