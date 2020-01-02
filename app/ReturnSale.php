<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReturnSale extends Model
{
    protected $fillable = [
        'members_id',
        'member_name',
        'id',
        'date',
        'biller_id',
        'biller_name',
        'branch_id',
        'branch_address',
        'total',
    ];

    public function member_name(){
        return $this->belongsTo(\App\Member::class);
    }
    public function biller(){
        return $this->belongsTo(\App\Biller::class);
    }
    public function branch(){
        return $this->belongsTo(\App\Branch::class);
    }
}
