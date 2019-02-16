<?php

namespace App\Domain;

use App\Mail\BetaInvite;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

class BetaUser extends Model
{
	use SoftDeletes;

    protected $table = 'beta_users';
    protected $guarded = [];

    public function sendInvite()
    {
		if(!$this->invite)
		{
			$this->invite = Crypt::encrypt($this->email);
			$this->save();
		}
	    Mail::to($this->email)->send(new BetaInvite($this));
    }

    public function getLink()
    {
		return url('/invite/' . $this->invite);
    }




}
