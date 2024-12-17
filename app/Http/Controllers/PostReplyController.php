<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reply;
use Spatie\Comments\Models\Comment;
use App\Notifications\PostReplyNotification;

class PostReplyController extends Controller
{
    
    public function store(Request $request)
    {

        $request->validate([
            'original_text' => 'required',
            'reaction' => 'nullable',
            
        ]);

        $reply = Comment::create([
 
            'commentable_id' => $request->input('commentable_id'),
            'commentable_type' => $request->input('commentable_type'),
            'parent_id' => $request->input('parent_id'),
            'commentator_id' => auth()->id(),
            'commentator_type' => 'App\Models\User',
            'original_text' => $request->input('original_text'),
        ]);

        $parentComment  = Comment::find($request->input('parent_id'));
        if (!$parentComment) {
            abort(404); // Not Found
        }
        $parentComment->commentator->notify(new PostReplyNotification($reply));

        return redirect()->back();
    }


    
    // Edit
    public function edit(Request $request, $id)
    {
        $reply = Reply::find($id);

        if (!$reply) {
            abort(404); // Not Found
        }
        
        // Check if the reply belongs to the authenticated user
        if ($reply->commentator_id != auth()->id()) {
            abort(403); // Forbidden
        }
        
        return view('posts.show', compact('reply'));
    }

    

    // Update
    public function update(Request $request, $id)
    {
        $reply = Reply::find($id);

        if (!$reply) {
            abort(404); // Not Found
        }
        
        // Check if the reply belongs to the authenticated user
        if ($reply->commentator_id != auth()->id()) {
            abort(403); // Forbidden
        }
        
        $request->validate([
            'original_text' => 'required',
        ]);
        
        $reply->update([
            'original_text' => $request->input('original_text'),
        ]);
        
        return redirect()->back();
    }

    // Delete
    public function destroy(Request $request, $id)
    {
        $reply = Reply::find($id);

        if (!$reply) {
            abort(404); // Not Found
        }
        
        // Check if the reply belongs to the authenticated user
        if ($reply->commentator_id != auth()->id()) {
            abort(403); // Forbidden
        }
        
        $reply->delete();
        
        return redirect()->back();
    }
    
}
