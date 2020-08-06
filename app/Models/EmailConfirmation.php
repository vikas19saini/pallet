<?php

namespace App\Models; 
use App\User;
use Illuminate\Database\Eloquent\Model;

class EmailConfirmation extends Model
{

    protected $table = "email_confirmation";

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}


