<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewLeaveNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Vous êtes en congé (' . $notifiable->latestLeave->leaveType->name . ') du' . getFormattedDate($notifiable->latestLeave->date_start) . ' ' . $notifiable->latestLeave->hour_start . ' au ' . getFormattedDate($notifiable->latestLeave->date_end) . ' ' . $notifiable->latestLeave->hour_end)
            ->action('Notification Action', url('/'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Vous êtes en congé (' . $notifiable->latestLeave->leaveType->name . ') du' . getFormattedDate($notifiable->latestLeave->date_start) . ' ' . $notifiable->latestLeave->hour_start . ' au ' . getFormattedDate($notifiable->latestLeave->date_end) . ' ' . $notifiable->latestLeave->hour_end
        ];
    }
}
