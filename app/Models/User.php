<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;
use Rappasoft\LaravelAuthenticationLog\Traits\AuthenticationLoggable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements Auditable, MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, \OwenIt\Auditing\Auditable, SoftDeletes, AuthenticationLoggable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected array $auditExclude = [
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at'        => 'datetime:d-m-Y',
        'updated_at'        => 'datetime:d-m-Y',
    ];

    /**
     * @param $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\ResetPasswordNotification($token, config('resetPasswordMailTemplate')));
    }

//    public function sendEmailVerificationNotification()
//    {
//
//    }

    public function getFullNameAttribute()
    {
        return $this->name;
    }
}
