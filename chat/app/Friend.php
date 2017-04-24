<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    //
    protected $fillable = [
        'id', 'user1', 'user2',
    ];
}
