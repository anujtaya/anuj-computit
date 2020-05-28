<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MobileNumberVerified extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $user_info;
    public function __construct($user_info)
    {
        $this->user_info = $user_info;
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
        return (new MailMessage)
                    ->from('info@local2local.com.au')
                    ->subject('LocaL2LocaL - Mobile Number Verified')
                    ->greeting('Hello '.$this->user_info->name.'!')
                    ->line('The mobile number ending with '.$this->user_info->mobile_number_masked. ' linked to your LocaL2LocaL account is now succefully verified. Now you can access your account dashboard in LocaL2LocaL application.')
                    ->action('Visit LocaL2LocaL', url('/'))
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
