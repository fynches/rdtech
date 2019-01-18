<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class GiftPage extends Model {
    
    protected $table = 'gift_page';
    protected $fillable = ['user_id','child_info_id', 'page_title', 'page_desc','page_date', 'page_hostname', 'added_gifts', 'background_id', 'live', 'rec_zip', 'favorites', 'gifts', 'slug'];
    
    public function child()
    {
        return $this->hasOne('App\ChildInfo', 'id', 'child_info_id' );
    }
    
    public function background_image()
    {
        return $this->hasOne('App\BackgroundImages', 'id', 'background_id' );
    }
    
    public function purchases()
    {
        return $this->hasMany('App\GiftPurchase','gift_page_id','id')->where('status', 2);
    }
    
    public function cust_purchases()
    {
        return $this->hasMany('App\UserGift','gift_id','id')->where('status', 2);
    }
    
} 

?>