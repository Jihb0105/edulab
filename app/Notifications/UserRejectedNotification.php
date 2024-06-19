<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class UserRejectedNotification extends Notification
{
    use Queueable;

    protected $user;
    protected $rejectReason;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, $rejectReason)
    {
        $this->user = $user;
        $this->rejectReason = $rejectReason;
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
                    ->line('Your application to register as an EduLab instructor has been rejected.')
                    ->line($this->rejectReason)
                    ->action('Register here again', route('register'))
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
