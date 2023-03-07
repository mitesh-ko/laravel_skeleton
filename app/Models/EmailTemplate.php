<?php

namespace App\Models;

use App\Casts\DecodeBodyCast;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class EmailTemplate extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'key',
        'name',
        'subject',
        'body'
    ];

    protected $casts = [
      'body' => DecodeBodyCast::class
    ];
}
