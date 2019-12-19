<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, HasRoles;

    protected $guard_name = 'api';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function branches()
    {
        return $this->hasMany(\App\Branch::class); 
    }

    public function products()
    {
        return $this->hasMany(\App\Product::class);
    }

    public function customers()
    {
        return $this->hasMany(\App\Customer::class);
    }

    public function sales()
    {
        return $this->hasMany(\App\Sale::class);
    }

    public function expenses()
    {
        return $this->hasMany(\App\Expense::class);
    }

    public function accounts()
    {
        return $this->hasOne(\App\Account::class);
    }

    public function department()
    {
        return $this->hasOne(\App\Department::class);
    }
}
