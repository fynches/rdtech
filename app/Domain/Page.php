<?php

namespace App\Domain;

use App\Mail\PageMadeLive;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;

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

    public function makeLive()
    {
	    $this->live = 1;
	    $this->save();
	    Mail::to($this->child->user->email)->send(new PageMadeLive($this));
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

    private function hydrateAddedGifts()
    {
	    $models  = null;
	    if($this->added_gifts && count($this->added_gifts))
	    {
	    	$models = [];
		    $gifts = Gift::whereIn('id',$this->added_gifts)->get();
		    foreach($gifts as $gift)
		    {
		    	$gift->balance = Gift::getBalance($gift->id, $this->id);
		    	$gift->gifted = $gift->price - $gift->balance;
		    	$models[] = $gift;
		    }
	    }
	    $this->added_gift_models = $models;
    }
    
} 
