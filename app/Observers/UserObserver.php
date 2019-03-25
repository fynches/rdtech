<?php

namespace App\Observers;

use App\Domain\User;
use App\Mail\UserCreated;
use Illuminate\Support\Facades\Mail;

class UserObserver
{
	public function created(User $user)
	{
		Mail::to($user->email)->send(new UserCreated($user));
	}


}