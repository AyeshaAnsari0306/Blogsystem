@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
@if (session('success'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif
    <h1 class="text-2xl font-bold mb-4">Create New Post</h1>
    @if ($errors->any())
    <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Title</label>
            <input type="text" name="title" class="w-full border p-2" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Body</label>
            <textarea name="body" rows="5" class="w-full border p-2" required></textarea>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Thumbnail Image</label>
            <input type="file" name="thumbnail" class="w-full border p-2" required>
        </div>

        <div class="mb-4">
    <label class="block mb-2 text-sm font-medium text-gray-700">Select Categories</label>
    <div class="flex flex-wrap gap-4">
        @foreach ($categories as $category)
            <label class="inline-flex items-center space-x-2 text-gray-700">
                <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="form-checkbox text-blue-600">
                <span>{{ $category->name }}</span>
            </label>
        @endforeach
    </div>
</div>


        <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded">
            Create Post
        </button>
    </form>
</div>
@endsection
