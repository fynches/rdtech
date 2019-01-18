<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'gift_alert',
        'fynches_updates',
        'google_visibility',
        'fynches_search_visibility',
        'user_status',
        'user_type',
        'user_id'
    ];
}
