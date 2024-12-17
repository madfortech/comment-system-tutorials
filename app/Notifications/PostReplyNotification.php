<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Spatie\Comments\Models\Comment;

class PostReplyNotification extends Notification
{
    use Queueable;
    private $reply;
    /**
     * Create a new notification instance.
     */
    public function __construct(Comment $reply)
    {
        $this->reply = $reply;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = url('/posts/' . $this->reply->commentable_id);

        return (new MailMessage)
            ->line('New reply received')
            ->action('View the reply on your post', url('/posts/' . $this->reply->commentable_id))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'reply_id' => $this->reply->id,
            'post_id' => $this->reply->commentable_id,
            'message' => 'You have received a new reply on your post.',

        ];
    }
}
