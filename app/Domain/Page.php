<?php

namespace App\Domain;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model {

	use SoftDeletes;

    protected $fillable = [
    	'child_id', 'title', 'description','date', 'hostname', 'added_gifts',
	    'background_id', 'live', 'received_gifts', 'favorite_gifts', 'slug'];
    protected $casts = [
    	'received_gifts' => 'array',
	    'favorite_gifts' => 'array',
	    'added_gifts' => 'array',
	    'date' => 'date'
    ];

    public function child()
    {
    	return $this->belongsTo( 'App\Domain\Child' );
    }
    
    public function background_image()
    {
        return $this->hasOne('App\BackgroundImages', 'id', 'background_id' );
    }

    public function purchases()
    {
        return $this->hasMany( 'App\Domain\Purchase')->where('status', 2);
    }

    public function hydrateGifts()
    {
		$this->hydrateFavoriteGifts();
		$this->hydrateAddedGifts();
    }

    private function hydrateFavoriteGifts()
    {
	    $this->favorite_gift_models = null;
	    if($this->favorite_gifts && count($this->favorite_gifts))
	    {
		    $this->favorite_gift_models = Gift::whereIn('id',$this->favorite_gifts)->get();
	    }
    }
	//
    private function hydrateAddedGifts()
    {
	    $this->added_gift_models = null;
	    if($this->added_gifts && count($this->added_gifts))
	    {
		    $this->added_gift_models = Gift::whereIn('id',$this->added_gifts)->get();
	    }
    }
    
} 
