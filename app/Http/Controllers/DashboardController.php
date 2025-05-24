<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('Admin')) {
            return view('dashboard.admin', [
                'recentPosts' => Post::with('categories')->latest()->take(5)->get(),
                'postCount' => Post::count(),
                'userRoles' => Role::withCount('users')->get(),
                'commentsCount' => Comment::count(),
            ]);
        } else {
            $userId = auth()->id();

            return view('dashboard.author', [
                'recentPosts' => Post::with('categories')->where('user_id', $userId)->latest()->take(5)->get(),
                'postCount' => Post::where('user_id', $userId)->count(),
                'commentsCount' => Comment::whereHas('post', function($query) use ($userId) {
                    $query->where('user_id', $userId);
                })->count(),
            ]);
        }
    }
}
