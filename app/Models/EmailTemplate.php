<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected function body(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  $value,
            set: fn ($value) =>  json_encode($value),
        );
    }

}
