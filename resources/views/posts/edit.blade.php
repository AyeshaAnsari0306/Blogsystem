@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Post</h1>

    <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Title</label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}" class="w-full border p-2" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Body</label>
            <textarea name="body" rows="5" class="w-full border p-2" required>{{ old('body', $post->body) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Current Thumbnail</label><br>
            <img src="{{ asset('storage/' . $post->thumbnail) }}" width="150">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Change Thumbnail</label>
            <input type="file" name="thumbnail" class="w-full border p-2">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Categories</label>
            @foreach ($categories as $category)
                <div>
                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                    {{ $post->categories->contains($category->id) ? 'checked' : '' }}>
                    {{ $category->name }}
                </div>
            @endforeach
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">
            Update Post
        </button>
    </form>
</div>
@endsection
