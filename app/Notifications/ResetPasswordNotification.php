<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    private $token;
    private $template;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, $template)
    {
        $this->token = $token;
        $this->template = $template;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return $this->buildMailMessage($notifiable, "$this->token?email={$notifiable->getEmailForPasswordReset()}");

    }

    protected function buildMailMessage($notifiable, $url)
    {
        $message = new MailMessage();
        $message->subject($this->template->subject);
        foreach ($this->template->body as $value) {
            $key = array_keys($value)[0];
            $replaced = str_replace('{PASSWORD_EXPIRED}', config('auth.passwords.users.expire'), $value[$key] ?? '');
            $replaced = str_replace('{FULL_NAME}', $notifiable->full_name, $replaced);
            if ($key == 'Line')
                $message->line($replaced);
            elseif ($key == 'Action')
                $message->action($replaced, route("password.reset", $url));
            elseif ($key == 'Greeting')
                $message->greeting($replaced);
        }
        return $message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
