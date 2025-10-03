<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class AdminController extends Controller
{
    // Show admin dashboard with all posts
    public function dashboard(Request $request)
    {
        if ($request->user()->usertype !== 'admin') {
            return redirect()->route('dashboard'); // redirect non-admin users
        }

        $posts = Post::latest()->get(); // fetch all posts
        return view('admin.dashboard', compact('posts'));
    }

    // Show all posts in paginated table
    public function allPosts(Request $request)
    {
        if ($request->user()->usertype !== 'admin') {
            abort(403, 'Unauthorized');
        }

        $posts = Post::latest()->paginate(10);
        return view('admin.allpost', compact('posts'));
    }

    // Show the form to create a new post
    public function createPost(Request $request)
    {
        if ($request->user()->usertype !== 'admin') {
            return redirect()->route('dashboard');
        }

        return view('admin.createpost');
    }

    // Store the new post in the database
    public function storePost(Request $request)
    {
        if ($request->user()->usertype !== 'admin') {
            return redirect()->route('dashboard');
        }

        $request->validate([
            'post_title'   => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }


        Post::create([
            'post_title' => $request->post_title,
            'description' => $request->description,
            'image' => $imagePath,
            'user_name' => $request->user()->name,
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('admin.allpost')->with('success', 'Post created successfully!');
    }

    // ==============================
    // NEW: Edit / Update / Delete
    // ==============================

    // Show edit form
    public function editPost($id)
    {
        $post = Post::findOrFail($id);

        return view('admin.editpost', compact('post'));
    }

    // Update post
    public function updatePost(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'post_title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $post->update([
            'post_title' => $request->post_title,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.allpost')->with('success', 'Post updated successfully!');
    }

    // Delete post
    public function deletePost($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('admin.allpost')->with('success', 'Post deleted successfully!');
    }
}

