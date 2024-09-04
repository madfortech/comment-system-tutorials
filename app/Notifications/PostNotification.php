<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostNotification extends Notification
{
    use Queueable;
    public $post;
    public $comment;
    public $commenter;
    /**
     * Create a new notification instance.
     */
    public function __construct($post, $comment, $commenter)
    {
        $this->post = $post;
        $this->comment = $comment;
        $this->commenter = $commenter;
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
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
           'post' => [
                'id' => $this->post->id,
                'description' => $this->post->description,
            ],
            'comment' => [
                'original_text' => $this->comment->original_text,
            ],
            'commenter' => [
                'username' => $this->commenter->username,
            ],
        ];
    }

    public function toJson(): string
    {
        return json_encode($this->toArray());
    }
}
