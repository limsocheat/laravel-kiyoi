<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['image', 'phone', 'address', 'city', 'country', 'user_id', 'member_id'];

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function member()
    {
        return $this->belongsTo(\App\Member::class);
    }
}
