@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">{{ $post->title }}</h1>
    <div class="max-w-4xl mx-auto px-4">
    <img src="{{ asset('storage/' . $post->thumbnail) }}"
         alt="{{ $post->title }}"width="150">
</div>

    <p class="mb-4">{{ $post->body }}</p>

    <hr class="my-6">

    <h2 class="text-xl font-semibold mb-2">Comments</h2>

    @foreach ($post->comments as $comment)
        <div class="mb-4 p-3 bg-gray-100 rounded">
            <strong>{{ $comment->user->name }}</strong>
            <p class="text-sm text-gray-600">{{ $comment->created_at->diffForHumans() }}</p>
            <p>{{ $comment->body }}</p>
        </div>
    @endforeach

    @auth
    <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-6">
        @csrf
        <div class="mb-4">
            <label for="body" class="block mb-1 font-semibold">Leave a Comment</label>
            <textarea name="body" id="body" rows="4" class="w-full border p-2 rounded" required></textarea>
        </div>
        <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-700">
            Submit Comment
        </button>
    </form>
@else
    <p class="mt-4 text-gray-600">You must <a href="{{ route('login') }}" class="text-blue-600 underline">login</a> to leave a comment.</p>
@endauth

</div>
@endsection
