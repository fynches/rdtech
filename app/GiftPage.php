<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class GiftPage extends Model {
    
    protected $table = 'gift_page';
    protected $fillable = [
    	'user_id','child_info_id', 'page_title', 'page_desc','page_date', 'page_hostname', 'added_gifts',
	    'background_id', 'live', 'rec_zip', 'favorites', 'gifts', 'slug'];
    protected $casts = [
    	'rec_zip' => 'array',
	    'favorites' => 'array',
	    'added_gifts' => 'array'
    ];

    public function child_info()
    {
    	return $this->belongsTo('App\ChildInfo');
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

    public function hydrateGifts()
    {
		$this->hydrateFavoriteGifts();
		$this->hydrateAddedGifts();
    }

    private function hydrateFavoriteGifts()
    {
	    $user = Auth::user();
	    $this->favorite_gift_models = null;
	    if($this->favorites && count($this->favorites))
	    {
		    $favorites = Gift::whereIn('id',$this->favorites)->get();
		    $custom_gifts = UserGift::where('user_id', $user->id)->whereIn('id',$this->favorites)->get();
		    foreach($custom_gifts as $gift)
		    {
			    if(!isset($gift->gift))
			    {
				    $newGift = new Gift;
				    $newGift->id = $gift->id;
				    $newGift->name = $gift->name;
				    $newGift->title = $gift->title;
				    $newGift->for_ages = $gift->for_ages;
				    $newGift->price = $gift->price;
				    $newGift->details = $gift->details;
				    $newGift->description = $gift->description;
				    $newGift->published = $gift->published;
				    $newGift->categories = $gift->categories;
				    $newGift->featured = $gift->featured;
				    $newGift->gift_image = $gift->gift_image;
				    $favorites->push($newGift);
			    }
		    }
		    $favoriteIds = $this->favorites;
		    $this->favorite_gift_models = $favorites->sortBy(function($model) use ($favoriteIds)
		    {
			    return array_search($model->getKey(), $favoriteIds);
		    });
	    }
    }
	//
    private function hydrateAddedGifts()
    {
	    $user = Auth::user();
	    $this->added_gift_models = null;
	    if($this->added_gifts && count($this->added_gifts))
	    {
		    $added = Gift::whereIn('id',$this->added_gifts)->get();
		    //TODO - refactor below - user gifts use same ids as regular gifts and will conflict
		    $custom_gifts = UserGift::where('user_id', $user->id)->whereIn('id',$this->added_gifts)->get();
		    foreach($custom_gifts as $gift)
		    {
			    if(!isset($gift->gift))
			    {
				    $newGift = new Gift;
				    $newGift->id = $gift->id;
				    $newGift->name = $gift->name;
				    $newGift->title = $gift->title;
				    $newGift->for_ages = $gift->for_ages;
				    $newGift->price = $gift->price;
				    $newGift->details = $gift->details;
				    $newGift->description = $gift->description;
				    $newGift->published = $gift->published;
				    $newGift->categories = $gift->categories;
				    $newGift->featured = $gift->featured;
				    $newGift->gift_image = $gift->gift_image;
				    $added->push($newGift);
			    }

		    }
		    $added_gifts_ids = $this->added_gifts;
		    $this->added_gift_models = $added->sortBy(function($model) use ($added_gifts_ids){
			    return array_search($model->getKey(), $added_gifts_ids);
		    });
	    }
    }
    
} 

?>