<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; 
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class PostController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('Admin')) {
            $posts = Post::latest()->get();
        } else {
            $posts = Post::where('user_id', auth()->id())->latest()->get();
        }
    
        return view('posts.index', compact('posts'));
    }
    public function myPosts()
{
    $posts = Post::where('user_id', auth()->id())->latest()->get();
    return view('posts.my-posts', compact('posts'));
}
public function allPosts()
{
    $posts = Post::latest()->get();
    return view('posts.all-posts', compact('posts'));
}

public function create()
{
    $categories = Category::all();
    return view('posts.create', compact('categories'));
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'body' => 'required',
        'thumbnail' => 'required|image',
        'categories' => 'required|array',
    ]);

    $path = $request->file('thumbnail')->store('thumbnails', 'public');
    $post = Post::create([
        'title' => $request->title,
        'body' => $request->body,
        'thumbnail' => $path,
        'user_id' => auth()->id()
    ]);

    $post->categories()->sync($request->categories);

    return redirect()->route('posts.index')->with('success', 'Post created successfully.');
}

public function edit(Post $post)
{
    if ($post->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }

    $categories = Category::all();
    return view('posts.edit', compact('post', 'categories'));
}

public function update(Request $request, Post $post)
{
     if ($post->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }
    $this->authorize('update', $post);
        $request->validate([
        'title' => 'required',
        'body' => 'required',
        'categories' => 'required|array',
    ]);

    $data = $request->only(['title', 'body']);
    if ($request->hasFile('thumbnail')) {
        $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
    }

    $post->update($data);
    $post->categories()->sync($request->categories);

    return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
}
public function destroy(Post $post)
{
     if ($post->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }
    $this->authorize('delete', $post);
    $post->delete();
    return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
}
public function show(Post $post)
{
    $post->load('comments.user'); //load comments + user

    return view('posts.show', compact('post'));
}


}
