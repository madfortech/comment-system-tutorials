<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Comments\Models\Comment;

class Reply extends Model
{
    use HasFactory;

    protected $table = 'comments'; // Add this line

    protected $fillable = [
        'commentable',
        'original_text',
        'text',
        
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'approved_at',
    ];

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
}
