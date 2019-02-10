<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public function giftBalance()
    {
    	return Gift::getBalance($this->gift_id, $this->page_id) - $this->amount;
    }
}

?>