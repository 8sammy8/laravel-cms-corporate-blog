<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Subscribe extends Notification
{
    use Queueable;

    /**
     * @var \App\Models\Subscribe
     */
    private $subscribe;
    /**
     * Subscribe constructor.
     *
     * @param \App\Models\Subscribe $subscribe
     */
    public function __construct(\App\Models\Subscribe $subscribe)
    {
        $this->subscribe = $subscribe;
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
        $url = route('unsubscribe', ['hash' => encrypt($this->subscribe->email)]);

        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Unsubscribe Action', $url)
                    ->line('Thank you for using our application!');
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
