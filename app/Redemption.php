<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Redemption extends Model
{
    protected $table = 'redemptions';
    protected $fillable = ['id', 'user_id', 'amount'];
}
