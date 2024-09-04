<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class CommentNotificationSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'commentable',
        'subscriber',
        'type',
        
    ];

    public function comment()
    {
        return $this->morphTo();
    }

    public function commentNotificationSubscriptions()
    {
        return $this->morphMany(CommentNotificationSubscription::class, 'commentable');
    }
}
