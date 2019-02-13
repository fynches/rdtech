<?php

namespace App\Observers;

use App\Domain\Payment;
use App\Domain\StripeAccount;
use App\Mail\PaymentCreated;
use App\Mail\StripeAccountCreated;
use Illuminate\Support\Facades\Mail;

class StripeAccountObserver
{
	public function created(StripeAccount $stripeAccount)
	{
		Mail::to($stripeAccount->user->email)->send(new StripeAccountCreated($stripeAccount));
	}


}