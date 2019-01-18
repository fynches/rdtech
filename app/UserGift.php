<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class UserGift extends Model {
    
    protected $table = 'user_gifts';
    protected $guarded = ['id'];
    
    public function age_range()
    {
        return $this->hasOne('App\AgeRange','id','for_ages');
    }
    
    public function gift()
    {
        return $this->hasOne('App\Gift','id','gift_id');
    }
    
    public function needed($page_id)
    {
        return $this->hasMany('App\GiftPurchase','gift_id','id')->where('status', 2)->where('gift_page_id', $page_id);
    }
    
    public function purchases($page_id)
    {
        return $this->hasMany('App\GiftPurchase','gift_id','gift_id')->where('status', 2)->where('gift_page_id', $page_id);
    }
}

?>