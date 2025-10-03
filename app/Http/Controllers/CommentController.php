<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        // Validate input
        $request->validate([
            'author_name' => 'required|string|max:100',
            'content' => 'required|string',
        ]);

        // Find the post
        $post = Post::findOrFail($postId);

        // Create the comment linked to the post
        $post->comments()->create([
            'author_name' => $request->author_name,
            'content' => $request->content,
        ]);

        // Redirect back to the post with success message
        return back()->with('success', 'Comment added successfully!');
    }
}

