<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportMessage extends Model
{
    public function ticket(){
        return $this->belongsTo(SupportTicket::class, 'supportticket_id', 'id');
    }
}
