<?php

namespace App\Models;


use App\User;
use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function country_obj()
    {
        return $this->belongsTo(Countries::class, 'country', 'country_id');
    }

    public function state_obj()
    {
        return $this->belongsTo(States::class, 'state', 'zone_id');
    }

}
