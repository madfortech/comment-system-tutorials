<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
     
    protected $fillable = [
        'commentable_id',
        'commentable_type',
        'commentator_id',
        'commentator_type',
        'original_text',
        'text',
        'parent_id', // Add this line
        
    ];

    protected $dates = [
        'approved_at'
    ];

    public function reactions()
    {
        return $this->hasMany(Reaction::class);
    }

    public function commentNotificationSubscriptions()
    {
        return $this->hasMany(CommentNotificationSubscription::class);
    }

    public function commentator()
    {
        return $this->morphTo();
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function post()
    {
        return $this->morphTo();
    }
}
