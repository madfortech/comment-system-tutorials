<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Reply;
use App\Models\Post;
use App\Models\User;
use Spatie\Comments\Models\Comment;

class ReplyControllerTest extends TestCase
{
    /**
     * A basic feature test example.
    */
    public function test_store_reply()
    {
        $comment = Comment::factory()->create();
        $response = $this->post(route('replies.store'), [
            'original_text' => 'Test Reply',
            'commentable_id' => $comment->id,
            'commentable_type' => 'App\Models\Post',
            'parent_id' => $comment->id,
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('comments', [
            'original_text' => 'Test Reply',
        ]);
    }

    public function test_edit_reply()
    {
        $post = Post::factory()->create();
        $reply = Reply::factory()->create(['commentable_id' => $post->id]);
        $user = User::factory()->create();
        
        // Give user permission to edit reply
        $user->assignRole('reply-editor'); // or any other role
        
        $response = $this->actingAs($user)
            ->get(route('replies.edit', $reply->id));
        
        $response->assertStatus(200);
        $response->assertViewIs('posts.show');
        $response->assertViewHas('reply', $reply);
        $response->assertViewHas('post', $post);
    }

    public function test_update_reply()
    {
        $reply = Reply::factory()->create();
        $response = $this->put(route('replies.update', $reply->id), [
            'original_text' => 'Updated Test Reply',
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('comments', [
            'original_text' => 'Updated Test Reply',
        ]);
    }

    public function test_delete_reply()
    {
        $reply = Reply::factory()->create();
        $response = $this->delete(route('replies.destroy', $reply->id));
        $response->assertStatus(302);
        $this->assertDatabaseMissing('comments', [
            'id' => $reply->id,
        ]);
    }
}
