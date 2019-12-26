<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = [
        'members_id' , 'members' , 'date' , 'supplier' , 'quotation_status' , 'total' , 'description'
    ];
    public function members(){
        return $this->belongsTo(\App\Member::class);
    }
    public function suppliers(){
        return $this->belongsTo(\App\Supplier::class);
    }
}