<?php

namespace App\Observers;

use App\Domain\Payment;
use App\Mail\PaymentCreated;
use Illuminate\Support\Facades\Mail;

class PaymentObserver
{
	public function created(Payment $payment)
	{
		Mail::to($payment->email)->send(new PaymentCreated($payment));
	}


}