<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPayslipNotification extends Notification
{
    use Queueable;

    public $payslip;
    public $period_start;
    public $period_end;

    /**
     * Create a new notification instance.
     */
    public function __construct($payslip, $period_start, $period_end)
    {
        $this->payslip = $payslip;
        $this->period_start = $period_start;
        $this->period_end = $period_end;
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
            ->line('Nouvelle fiche de paie.')
            ->action('Notification Action', url('/'))
            ->attach(storage_path("payslips" . $this->payslip));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Nouvelle fiche de paie (période du' . $this->period_start . 'au' . $this->period_end . ')'
        ];
    }
}
