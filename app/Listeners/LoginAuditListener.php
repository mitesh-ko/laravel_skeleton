<?php

namespace App\Listeners;

use App\Models\User;
use Carbon\Carbon;
use Event;
use OwenIt\Auditing\Events\AuditCustom;

class LoginAuditListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        $user = \Auth::user();
        $newData = [
            'ip'       => \Request::getClientIp(),
            'login_at' => Carbon::now()
        ];
        $oldData = [
            'ip'       => $user->ip,
            'login_at' => $user->login_at
        ];
        User::where('id', \Auth::id())->update($newData);

        $user->auditEvent = 'Login';
        $user->isCustomEvent = true;
        $user->auditCustomOld = $oldData;
        $user->auditCustomNew = $newData;
        Event::dispatch(AuditCustom::class, [$user]);
    }
}
