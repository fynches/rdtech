<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model {
    
    protected $table = 'purchases';
    protected $fillable = ['user_id', 'gift_id', 'session_id', 'page_id', 'amount', 'status', 'email'];
    
    public $timestamps = false;
    
    public function gift()
    {
        return $this->belongsTo('App\Domain\Gift');
    }
    
    public function page()
    {
        return $this->belongsTo( 'App\Domain\Page');
    }

    public function giftBalance()
    {
    	return Gift::getBalance($this->gift_id, $this->page_id) - $this->amount;
    }
}

?>