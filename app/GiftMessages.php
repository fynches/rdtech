<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class GiftMessages extends Model {
    
    protected $table = 'giftMessages';
    protected $fillable = ['id', 'name', 'message', 'created_at'];
    
    public $timestamps = false;
    
    
}

?>