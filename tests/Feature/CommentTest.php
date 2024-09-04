<?php
 
test('create comment', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create();

    $response = $this->actingAs($user)
        ->post('/comments', [
            'commentable_id' => $post->id,
            'commentable_type' => 'App\Models\Post',
            'original_text' => 'This is a test comment',
        ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('comments', [
        'original_text' => 'This is a test comment',
    ]);
});