<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class WelcomeMailListener
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
        // Developer can remove this check if they always use a mail configuration.
        if (config('site.mail_enabled'))
            $event->user->notify(new \App\Notifications\WelcomeNotification(['template' => config('site.emailTemplate.welcomeEmail')]));
    }
}
