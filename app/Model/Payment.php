<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $guarded = [];

    public function bills(){
        return $this->hasMany(Bill::class);
    }
}