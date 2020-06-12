<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class JobStatusUpdate extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $data_array;
    public function __construct($data_array)
    {
        $this->data_array = $data_array;
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
        ->greeting('Hello '.$this->data_array->service_provider_name.',')
        ->subject('LocaL2LocaL - Job Status Updated')
        //->greeting('Hello '.$this->data_array->service_provider_name.',')
        //->theme('default')
        ->markdown('mail.job.status_update', ['job' => $this->data_array]);
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
