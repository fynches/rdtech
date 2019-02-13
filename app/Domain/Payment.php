<?php

namespace App\Domain;

use App\Mail\PaymentCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;

class Payment extends Model
{
	use SoftDeletes;

    protected $guarded = [];
	protected $casts = [
		'stripe_data' => 'array'
		];


    public function purchases()
    {
    	return $this->hasMany('App\Domain\Purchase');
    }

    public function notify()
    {
	    Mail::to($this->email)->send(new PaymentCreated($this));
    }

}
