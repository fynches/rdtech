<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StaticPage extends Model {

	use SoftDeletes;

	protected $guarded = [];

} 
