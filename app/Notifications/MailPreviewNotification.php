<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MailPreviewNotification extends Notification
{
    use Queueable;

    private $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
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
        return $this->buildMailMessage($notifiable);
    }

    public function buildMailMessage($notifiable)
    {
        $message = new MailMessage();
        $message->subject($this->data['template']->subject);
        $replacement = [
            '{FULL_NAME}'        => $notifiable->full_name,
            '{PASSWORD_EXPIRED}' => config('auth.passwords.users.expire'),
            '{DESCRIPTION}'      => $this->data['desc'] ?? ''
        ];
        $replaced = str_replace(array_keys($replacement), array_values($replacement), $this->data['template']->body ?? '');
        foreach (json_decode($replaced, true) as $value) {
            $key = array_keys($value)[0];
            if ($key == 'Line')
                $message->line($value[$key]);
            elseif ($key == 'Action')
                $message->action($value[$key], $this->data['actionUrl'] ?? '');
            elseif ($key == 'Greeting')
                $message->greeting($value[$key]);
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
