<?php

namespace App\Models;

use App\Casts\UserProfileCast;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;
use Rappasoft\LaravelAuthenticationLog\Traits\AuthenticationLoggable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements Auditable, MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, \OwenIt\Auditing\Auditable, SoftDeletes, AuthenticationLoggable;

    protected $fillable = [
        'username',
        'name',
        'email',
        'phone',
        'profile',
        'password',
        'twofa_key',
        'support_pin'
    ];

    protected array $auditExclude = [
        'password',
        'remember_token',
        'twofa_key',
        'support_pin'
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
        'profile'           => UserProfileCast::class
    ];

    /**
     * @param $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $token = route("password.reset", $token) . "?email={$this->getEmailForPasswordReset()}";
        $this->notify(new \App\Notifications\ResetPasswordNotification(['actionUrl' => $token, 'template' => config('site.emailTemplate.resetPassword')]));
    }

    public function sendEmailVerificationNotification()
    {
        if (config('site.mail_verification'))
            $this->notify(new VerifyEmail);
    }

    public function getFullNameAttribute()
    {
        return $this->name;
    }
}
