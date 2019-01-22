<?php

namespace App\Domain;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Gift extends Model {

	use SoftDeletes;
    
    protected $table = 'gifts';
    protected $guarded = ['id'];

    public function categories()
    {
    	return $this->belongsToMany('App\Domain\Category');
    }
    
    public function business() 
    {
        return $this->hasOne('App\Business','id','business_id');
    }
    
    public function images() 
    {
        return $this->hasOne('App\Images','business_id','business_id');
    }
    
    public function age_range()
    {
        return $this->hasOne('App\AgeRange','id','for_ages');
    }
    
    public function needed($page_id)
    {
        return $this->hasMany('App\GiftPurchase','gift_id','id')->where('status', 2)->where('gift_page_id', $page_id);
    }
    
    public function custom() {
        $user_id = Auth::user()->id;
        return $this->hasOne('App\Domain\UserGift','gift_id','id')->where('user_id',$user_id);
    }
    
    public function purchases($page_id)
    {
        return $this->hasMany('App\GiftPurchase','gift_id','id')->where('status', 2)->where('gift_page_id', $page_id);
    }

    public static function getPublicGifts()
    {
    	return self::whereNull("user_id")->get();
    }

    public static function getChildRecommendedGifts(Child $child)
    {
	    return self::where('min_age', '<=', $child->age)
	               ->where('max_age', '>=', $child->age)
		            ->whereRaw("(ISNULL(user_id) OR user_id = {$child->user->id})")
	               ->get();
    }

	public static function getUserGifts(User $user)
	{
		return self::whereRaw("ISNULL(user_id) OR user_id = {$user->id}")->get();
	}
}

?>