@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Manage Comments</h1>

    @if ($comments->count())
        <div class="space-y-4">
            @foreach ($comments as $comment)
                <div class="bg-white p-4 rounded shadow">
                    <p><strong>{{ $comment->user->name }}</strong> on 
                        <a href="{{ route('posts.show', $comment->post_id) }}" class="text-blue-600 hover:underline">
                            {{ $comment->post->title }}
                        </a>
                    </p>
                    <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                    <p>{{ $comment->body }}</p>
                </div>
            @endforeach
        </div>
    @else
        <p>No comments available.</p>
    @endif
</div>
@endsection
