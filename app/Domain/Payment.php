<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

}
