<?php

namespace App\Notifications\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LoginOtpMail extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected string $otp,
        protected string $device,
        protected string $browser,
        protected string $ip,
        protected string $fullName,
        protected string $title
    ) {
        //
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }


    public function toMail(object $notifiable): MailMessage
    {

        return (new MailMessage)
            ->subject('Verify Your New Device - Unity Co-op')
            ->view('emails.admin.verify-login-otp', [
                'device' => $this->device,
                'otp' => $this->otp,
                'browser' => $this->browser,
                'ip' => $this->ip,
                'fullName' => $this->fullName,
                'title' =>$this->title,
            ]);
    }

    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
