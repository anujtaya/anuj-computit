<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AccountCreated extends Notification
{
    use Queueable;
    protected   $options;
    protected   $user_name;

    public function __construct($user_name)
    {
       
        $data = [
            'url1' =>'https://local2local.com.au/marketAbout',
            'url2' =>'https://local2local.com.au/#main-video-tag'
       ];
      
        $this->options = $data;
        $this->user_name = $user_name;
    }
   
    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                ->from('info@local2local.com.au')
                ->greeting('Hello '.$this->user_name.',')
                ->subject('Welcome to the LocaL2LocaL Community.')
                ->markdown('mail.account.service_seeker_account_created', $this->options);
              
    }
    
    public function toArray($notifiable)
    {
        return [
           
        ];
    }
}
