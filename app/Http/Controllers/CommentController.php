<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Spatie\Comments\Models\Comment;
use App\Notifications\PostNotification;
use Illuminate\Support\Facades\Auth;
 

class CommentController extends Controller
{

    // Store
    public function store(Request $request)
    {
        $request->validate([
            'original_text' => 'required',
            'reaction' => 'nullable',
        ]);

        $comment = Comment::create([
 
            'commentable_id' => $request->input('commentable_id'),
            'commentable_type' => 'App\Models\Post',
            'commentator_id' => auth()->id(),
            'commentator_type' => 'App\Models\User',
            'original_text' => $request->input('original_text'),
        ]);

       
        $post = Post::find($request->input('commentable_id'));
     
        
        $post->user->notify(new PostNotification($post,  $comment, auth()->user()));

        return redirect()->back();
    }

    // Edit
    public function edit(Comment $comment)
    {
        if (!$comment) {
            return back()->withErrors(['comment' => 'Comment not found']);
        }

        return view('comments.edit', compact('comment'));
    }


    // Update 
    public function update(Request $request, Comment $comment)
    {
        if (!$comment) {
            return back()->withErrors(['comment' => 'Comment not found']);
        }

        $request->validate([
            'original_text' => 'required',
            'reaction' => 'nullable',
        ]);

        $comment->update([
            'original_text' => $request->input('original_text'),
        ]);
        
       $post = Post::find($request->input('commentable_id'));



        // Update notification
        $notification = Auth::user()->notifications()->where('type', 'App\Notifications\PostNotification')
        ->where('data->post->id', $comment->post_id)
        ->first();

        if ($notification) {
            $notification->data = json_encode([
                'post' => [
                    'id' => $post->id,
                    'description' => $comment->post->description,
                ],
                'comment' => [
                    'original_text' => $comment->original_text,
                ],
                'commenter' => [
                    'username' => $comment->commentator->username,
                ],
            ]);
            $notification->save();
        }

        return redirect()->back();
    }

    // Delete
    public function delete(Comment $comment){

        $comment->delete();
        return redirect()->back();
        
    }
    
}
