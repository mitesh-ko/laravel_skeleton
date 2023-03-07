<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification
{
    use Queueable;

    private $template;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($template)
    {
        $this->template = $template;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return $this->buildMailMessage($notifiable);
    }

    protected function buildMailMessage($notifiable)
    {
        $message = new MailMessage();
        $message->subject($this->template->subject);
        foreach ($this->template->body as $value) {
            $key = array_keys($value)[0];
            $replaced = str_replace('{FULL_NAME}', $notifiable->full_name, $value[$key] ?? '');
            if ($key == 'Line')
                $message->line($replaced);
            elseif ($key == 'Action')
                $message->action($replaced, url('/'));
            elseif ($key == 'Greeting')
                $message->greeting($replaced);
        }
        return $message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
