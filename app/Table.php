<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Table extends Model
{
    protected $guarded = [];

    public function users(){
        return $this->BelongsToMany(User::class,'user_tables','table_id','user_id');
    }
}