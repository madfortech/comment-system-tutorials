<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Notification;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Notifications\PostNotification;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    /**
     * A basic feature test example.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Create a user and login
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    /**
     * @test
     */
    public function test_store_comment()
    {
        Notification::fake();

        $post = Post::factory()->create();

        $response = $this->post(route('comments.store'), [
            'commentable_id' => $post->id,
            'original_text' => 'This is a test comment',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('comments', [
            'commentable_id' => $post->id,
            'commentable_type' => 'App\Models\Post',
            'commentator_id' => $this->user->id,
            'original_text' => 'This is a test comment',
        ]);

        Notification::assertSentTo($post->user, PostNotification::class);
    }

    /**
     * @test
     */
    public function test_edit_comment()
    {
        $comment = Comment::factory()->create(['commentator_id' => $this->user->id]);
        
        $this->assertDatabaseHas('comments', ['id' => $comment->id]);
        
        $response = $this->get(route('comments.edit', $comment->id));
        $response->assertStatus(200);
        $response->assertViewIs('components.comments.edit');
        $response->assertViewHas('comment', $comment);
        
    }

    /**
     * @test
     */
    public function test_update_comment()
    {
        $comment = Comment::factory()->create(['commentator_id' => $this->user->id]);

        $response = $this->put(route('comments.update', $comment->id), [
            'original_text' => 'Updated comment text',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('comments', [
            'id' => $comment->id,
            'original_text' => 'Updated comment text',
        ]);
    }

    /**
     * @test
     */
    public function test_delete_comment()
    {
        $comment = Comment::factory()->create(['commentator_id' => $this->user->id]);
        
        $this->assertDatabaseHas('comments', ['id' => $comment->id]);
        
        $response = $this->delete(route('comments.delete', $comment->id));
        $response->assertStatus(302);
        
        $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
    }

    /**
     * @test
     */
    public function test_store_comment_validation()
    {
        $post = Post::factory()->create();

        $response = $this->post(route('comments.store'), [
            'commentable_id' => $post->id,
        ]);

        $response->assertSessionHasErrors('original_text');
    }
}
