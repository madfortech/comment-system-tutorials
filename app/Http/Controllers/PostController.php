<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->get();
        return view('posts.index', compact('posts'));
    }


    public function create()
    {
        return view('posts.create');
    }


    public function store(Request $request)
    {
      
        $request->validate([
            'description' => 'required',
           
        ]);
        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = Auth::id();
        $post->save();
        return redirect()->back();
    }


    public function show($id)
    {

        $post = Post::with('user')->find($id);
        if (!$post) {
            // Handle post not found
            return abort(404);
        }
        $username = $post->user->username; // This will display the username associated with the post
        return view('posts.show', compact('post','username'));
    }

    public function destroy($id)
    {
        Post::findorFail($id)->delete();
        return redirect()->route('posts/index');
    }

}
