<?php

namespace App\Domain;

use App\Mail\PurchaseNotifyRecipient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;

class Purchase extends Model {

	use SoftDeletes;
    
    protected $table = 'purchases';
    protected $guarded = [];
    
    public function gift()
    {
        return $this->belongsTo('App\Domain\Gift');
    }
    
    public function page()
    {
        return $this->belongsTo( 'App\Domain\Page');
    }

    public function payment()
    {
    	return $this->belongsTo('App\Domain\Payment');
    }

    public function giftBalance()
    {
    	return Gift::getBalance($this->gift_id, $this->page_id) - $this->amount;
    }

    public function notifyRecipient()
    {
	    Mail::to($this->page->child->user->email)->send(new PurchaseNotifyRecipient($this));
    }
}