<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    if (auth()->user()->hasRole('Admin')) {
        $comments = \App\Models\Comment::with(['user', 'post'])->latest()->get();
    } else {
        $comments = \App\Models\Comment::whereHas('post', function ($query) {
            $query->where('user_id', auth()->id());
        })->with(['user', 'post'])->latest()->get();
    }

    return view('comments.index', compact('comments'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);
    
        $post->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);
    
        return back()->with('success', 'Comment added successfully!');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
