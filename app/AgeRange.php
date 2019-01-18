<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class AgeRange extends Model {
    
    protected $table = 'age_ranges';
    protected $fillable = ['id', 'age_range'];
}

?>