<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class Reaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'reaction',
        
    ];
 
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
