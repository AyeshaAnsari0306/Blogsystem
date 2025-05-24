@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">All Posts</h1>
    

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('posts.create') }}" class="bg-blue-700 text-white px-4 py-2 rounded">
        Create New Post
    </a>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach ($posts as $post)
            <div class="border p-4 rounded shadow">
                <img src="{{ asset('storage/' . $post->thumbnail) }}" class="w-full h-48 object-cover rounded">
                <h2 class="text-xl font-semibold">{{ $post->title }}</h2>
                <p class="text-gray-600">By: {{ $post->user->name }}</p>
                <p class="mt-2 text-sm text-gray-500">
            <strong>Categories:</strong>
            @foreach ($post->categories as $category)
                <span class="bg-gray-200 text-gray-800 px-2 py-1 rounded text-xs">{{ $category->name }}</span>
            @endforeach
        </p>
                <div class="mt-4">
                    <a href="{{ route('posts.edit', $post) }}" class="text-blue-500">Edit</a>
                    <a href="{{ route('posts.show', $post) }}" class="text-green-600 font-medium">View</a>
                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 ml-2" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
