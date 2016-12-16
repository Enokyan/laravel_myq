<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userfriendstable extends Model
{
    protected $fillable = [
        'from_user', 'to_user', 'status'
    ];
}
