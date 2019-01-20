<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChildInfo extends Model
{
    protected $table = 'child_info';
    protected $fillable = ['user_id', 'first_name', 'age_range', 'recipient_image', 'child_zipcode', 'gift_page_id', 'dob'];
    protected $appends = ['age'];
    
    public function gift_page()
    {
        return $this->hasOne('App\GiftPage');
    }
    
    public function message() 
    {
        return $this->hasMany('App\GiftMessages','child_info_id','id')->orderByDesc('created_at');
    }
    
    public function purchases()
    {
        return $this->hasMany('App\GiftPurchase', 'child_info_id', 'id' );
    }

	public function getAgeAttribute() {
		$then_ts = strtotime($this->dob);
		$then_year = date('Y', $then_ts);
		$age = date('Y') - $then_year;
		if(strtotime('+' . $age . ' years', $then_ts) > time()) $age--;
		return $age;
	}

}
