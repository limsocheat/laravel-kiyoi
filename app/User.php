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
        'name', 'email', 'password', 'address', 'referred_by', 'referral_code', 'image'
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

    protected $appends = ["role_ids", 'count_referrer', 'role_name'];

    public function getRoleNameAttribute()
    {
        return  $this->roles()->pluck('name');
    }

    public function getCountReferrerAttribute()
    {
        $user = User::where('referred_by', $this->first_name)
                    ->orWhere('referred_by', $this->last_name)->count();

        return $user;
    }
    
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

    public function getRoleIdsAttribute(){
        return $this->roles()->pluck('id');
    }

    public function calendars()
    {
        return $this->hasMany(\App\Calendar::class);
    }
}
