<?php 

// database/factories/ReplyFactory.php

namespace Database\Factories;

use App\Models\Reply;
use App\Models\Comment;
use Database\Factories\CommentFactory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    protected $model = Reply::class;

    public function definition()
    {
        return [
            'text' => $this->faker->text, // Add text column value
            'original_text' => $this->faker->text,
            'commentable_id' => fn () => Comment::factory()->create()->id,
            'commentable_type' => 'App\Models\Post',
            'parent_id' => fn () => Comment::factory()->create()->id,
        ];
    }
}