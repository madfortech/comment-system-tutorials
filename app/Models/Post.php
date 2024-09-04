<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Comments\Models\Concerns\HasComments;

class Post extends Model
{
    use HasFactory,HasComments;

    protected $table = 'posts';

    protected $fillable = ['title','description','user_id'];
 
    protected $dates = ['created_at', 'updated_at'];

    public function commentableName(): string
    {
        return 'Post'; 
    }

    public function commentUrl(): string
    {
        return route('post.show', $this->id); 
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUserNameAttribute()
    {
        return $this->user->username; // Access the username attribute from the user relationship
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->with('commentator');
    }
}
