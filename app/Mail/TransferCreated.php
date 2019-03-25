<?php

namespace App\Mail;

use App\Domain\Transfer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TransferCreated extends Mailable
{
    use Queueable, SerializesModels;

    /*
     * @var Transfer
     */
    public $transfer;

    public function __construct(Transfer $transfer)
    {
        $this->transfer = $transfer;
    }

    public function build()
    {
        return $this
	        ->subject("Your Funds Have Been Redeemed")
	        ->view('emails.transfer-created');
    }
}
