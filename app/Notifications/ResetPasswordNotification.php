<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;



class ResetPasswordNotification extends Notification
{
    use Queueable;

   
    // Create a new notification instance.
    public function __construct(
        protected string $token

    ){}

    // @return array<int, string>
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    
    // Get the mail representation of the notification.
   public function toMail($notifiable): MailMessage
    {
        $url = env('FRONTEND_URL') .
            '/reset-password?token=' . $this->token .
            '&email=' . urlencode($notifiable->email);

        return (new MailMessage)
            ->subject('Reset Your Password')
            ->line('You requested a password reset.')
            ->action('Reset Password', $url)
            ->line('If you did not request this, no action is required.');
    }
  
    // Get the array representation of the notification.
    // @return array<string, mixed>
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
