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
    }
}
