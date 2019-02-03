<?php

namespace App\Domain;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transfer extends Model
{
	use SoftDeletes;

    protected $guarded = [];

    public function account()
    {
    	return $this->belongsTo('App\Domain\StripeAccount');
    }

}
