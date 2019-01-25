<?php

namespace App\Domain;

use DB;
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
    	$purchases = Purchase::where('gift_id', $this->gift_id)->where('page_id', $this->page_id)->get();
    	$gift = Gift::find($this->gift_id);
    	$balance = $gift->price;
    	foreach($purchases as $purchase)
	    {
	    	$balance -= $purchase->amount;
	    }
    	$balance = $balance < 0 ? 0 : $balance;
    	return $balance;
    }
    
    //public function needed($page_id)
    //{
    //    return $this->hasMany( 'App\Purchase','gift_id','id')->where('status', 2)->where('gift_page_id', $page_id);
    //}
}

?>