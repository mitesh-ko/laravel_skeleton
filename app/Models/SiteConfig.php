<?php

namespace App\Models;

use App\Casts\DecryptMailPasswordCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * @method static insert(array $array)
 * @method static pluck(string $string, string $string1)
 */
class SiteConfig extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $auditEvents = [
        'deleted',
    ];

    protected $fillable = [
        'key',
        'value',
        'description'
    ];

    protected $casts = [
        'mail_password' => DecryptMailPasswordCast::class
    ];
}
