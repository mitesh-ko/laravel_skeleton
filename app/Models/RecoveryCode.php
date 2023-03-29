<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecoveryCode extends Model
{
    protected $fillable = [
        'user_id',
        'code'
    ];
}
