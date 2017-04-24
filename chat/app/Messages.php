<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    //
    protected $fillable = [
        'id', 'mes', 'user1','user2','mes_type','send_time'
    ];
}
