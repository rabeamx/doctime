<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DoctorForgotPasswordActivation extends Notification
{
    use Queueable;
    private $name;
    private $token;
    private $email;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($doctor_data)
    {
        $this -> name = $doctor_data -> name;
        $this -> email = $doctor_data -> email;
        $this -> token = $doctor_data -> access_token;
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
                    ->line('hi '. $this -> name.', confirm your email')
                    ->action('email confirm', url('/doctor_email_confirmation/'. $this -> token))
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
