<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use SoftDeletes;

    protected $table = 'categories';
    protected $fillable = ['name'];

    public function gifts()
    {
    	return $this->belongsToMany('App\Domain\Gift');
    }

}
