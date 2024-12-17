<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'commentable_id' => Post::factory(),
            'commentable_type' => 'App\Models\Post',
            'commentator_id' => User::factory(),
            'commentator_type' => 'App\Models\User',
            'text' => $this->faker->paragraph, // Change original_text to text
            'original_text' => $this->faker->paragraph, // Add this line
        ];
    }
}