<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Child extends Model
{
	use SoftDeletes;

    protected $table = 'children';
    protected $fillable = ['user_id', 'first_name', 'image', 'zipcode', 'dob'];
    protected $appends = ['age'];

    public function user()
    {
    	return $this->belongsTo('App\Domain\User');
    }
    
    public function pages()
    {
        return $this->hasMany( 'App\Domain\Page' );
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
