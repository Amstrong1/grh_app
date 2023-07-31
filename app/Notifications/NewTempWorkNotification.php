<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewTempWorkNotification extends Notification
{
    use Queueable;

    public $post;
    public $period;

    /**
     * Create a new notification instance.
     */
    public function __construct($post, $period)
    {
        $this->post = $post;
        $this->period = $period;
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
            ->line('Vous avez été sélectionner comme intérimaire pour le poste de ' . $this->post . ' du ' . $this->period)
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
            'message' => 'Vous avez été sélectionner comme intérimaire pour le poste de' . $this->post . ' du ' . $this->period
        ];
    }
}
