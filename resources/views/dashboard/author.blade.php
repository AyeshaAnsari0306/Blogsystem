@extends('layouts.app')

@section('content')

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Author Dashboard</h1>

    <p>Your Recent Posts:</p>
    <ul class="list-disc ml-6">
        @foreach ($recentPosts as $post)
            <li>{{ $post->title }}</li>
        @endforeach
    </ul>

    <div class="mt-4">
        <p><strong>Total Your Posts:</strong> {{ $postCount }}</p>
        <p><strong>Comments on Your Posts:</strong> {{ $commentsCount }}</p>
    </div>
    <div class="mb-6">
    <a href="{{ route('posts.index') }}" class="bg-blue-700 text-white px-4 py-2 rounded">
        Manage My Posts
    </a>
</div>


</div>
@endsection
