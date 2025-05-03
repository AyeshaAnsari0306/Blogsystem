<?php

namespace App\Http\Controllers;

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
    $categories = Category::all();
    return view('posts.edit', compact('post', 'categories'));
}

public function update(Request $request, Post $post)
{
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

}
