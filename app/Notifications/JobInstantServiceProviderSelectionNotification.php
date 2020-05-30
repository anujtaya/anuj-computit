<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class JobInstantServiceProviderSelectionNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $job;
    public function __construct($job)
    {
        $this->job = $job;
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
                    ->greeting('Hello there!')
                    ->subject('Action Required! You have got an Instant Job Quote request.')
                    ->line('A Service Seeker requested an Instant job quote for '.$this->job->service_category_name.'-'.$this->job->service_subcategory_name.'. You have 20 minutes to respond to with a price quote. Details of the job is availble in your LocaL2LocaL app.')
                    ->line('PLease visit your Service Provider Jobs menu for detailed job description. The instant job id is:'.$this->job->id)
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
