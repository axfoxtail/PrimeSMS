<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transections';
    protected $guarded = ['id'];
    public function to(){
        return $this->belongsTo(User::class, 'to_add', 'id');
    }

    public function from(){
        return $this->belongsTo(User::class, 'from_add', 'id');
    }
}
