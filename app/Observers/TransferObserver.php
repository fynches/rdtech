<?php

namespace App\Observers;

use App\Domain\Transfer;
use App\Mail\TransferCreated;
use Illuminate\Support\Facades\Mail;

class TransferObserver
{
	public function created(Transfer $transfer)
	{
		Mail::to($transfer->account->user->email)->send(new TransferCreated($transfer));
	}


}