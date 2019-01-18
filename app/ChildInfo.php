<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChildInfo extends Model
{
    protected $table = 'child_info';
    protected $fillable = ['user_id', 'first_name', 'age_range', 'recipient_image', 'child_zipcode', 'gift_page_id', 'dob'];
    
    public function gift_page()
    {
        return $this->hasOne('App\GiftPage', 'id', 'gift_page_id' );
    }
    
    public function message() 
    {
        return $this->hasMany('App\GiftMessages','child_info_id','id')->orderByDesc('created_at');
    }
    
    public function purchases()
    {
        return $this->hasMany('App\GiftPurchase', 'child_info_id', 'id' );
    }
}
