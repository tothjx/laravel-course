<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscriptionExpiringNotification extends Notification implements ShouldQueue
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
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Feliratkozásod hamarosan lejár')
            ->greeting('Kedves ' . $notifiable->name . '!')
            ->line('Értesítünk, hogy a feliratkozásod 10 napon belül lejár.')
            ->line('Feliratkozásod lejárati dátuma: ' . $notifiable->subscription_at?->format('Y-m-d'))
            ->action('Megújítás', url('/'))
            ->line('Köszönjük, hogy használod az alkalmazásunkat!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
