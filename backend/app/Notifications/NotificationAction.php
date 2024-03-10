<?php

namespace App\Notifications;

use App\Enums\NotificationTypeEnum;
use Illuminate\Bus\Queueable;
use App\Enums\NotificationType;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NotificationAction extends Notification implements ShouldBroadcast, ShouldQueue
{
  use Queueable;

  /**
   * Create a new notification instance.
   */

   public function __construct(public $type,public $message,public $model)
  {
  }

  /**
   * Get the notification's delivery channels.
   *
   * @return array<int, string>
   */
  public function via(object $notifiable): array
  {
    return ['broadcast', 'database'];
  }

  /**
   * Get the mail representation of the notification.
   */
  public function toMail(object $notifiable): MailMessage
  {
    return (new MailMessage)
      ->line('The introduction to the notification.')
      ->action('Notification Action', url('/'))
      ->line('Thank you for using our application!');
  }

  /**
   * Get the array representation of the notification.
   *
   * @return array<string, mixed>
   */
  public function toArray($notifiable)
  {
    return [
        'notification_type'   => $this->type,
        'item_id'             => $this->model?->id,
        'data'                => $this->model->toArray(),
        'message'             => $this->message,
        'created_at'          => (string)now(),
    ];
  }
}
