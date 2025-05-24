@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">

    {{-- Page Header 
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold">Author Dashboard</h1>
        <a href="{{ route('posts.create') }}"
           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">
            + New Post
        </a>
    </div>--}}

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        {{-- My Post Count --}}
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold text-gray-700">My Posts</h2>
            <p class="text-4xl font-bold text-gray-900">{{ $postCount }}</p>
        </div>

        {{-- My Comments --}}
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold text-gray-700">Comments on My Posts</h2>
            <p class="text-4xl font-bold text-gray-900">{{ $commentsCount }}</p>
        </div>

        {{--
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-lg font-semibold text-gray-700">Users by Role</h2>
    <ul class="mt-4 space-y-1 text-sm">
        @foreach(\Spatie\Permission\Models\Role::withCount('users')->get() as $role)
            <li class="flex justify-between">
                <span>{{ $role->name }}</span>
                <span class="font-bold">{{ $role->users_count }}</span>
            </li>
        @endforeach
    </ul>
</div>
--}}

        {{-- Recent Posts Count --}}
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold text-gray-700">Recent Posts</h2>
            <p class="text-4xl font-bold text-gray-900">{{ $recentPosts->count() }}</p>
        </div>
    </div>

    {{-- Recent Posts List --}}
    <div>
        <h2 class="text-2xl font-bold mb-4">My Recent Posts</h2>
        <div class="space-y-6">
            @forelse($recentPosts as $post)            
                <div class="bg-white p-6 rounded shadow">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-xl font-semibold">{{ $post->title }}</h3>
                        <p class="text-sm text-gray-500 mb-2">
    <strong>Categories:</strong>
    @forelse ($post->categories as $category)
        <span class="bg-gray-200 text-gray-800 px-2 py-1 rounded text-xs">{{ $category->name }}</span>
    @empty
        <span class="text-gray-400">No categories</span>
    @endforelse
</p>

                        <small class="text-gray-500">{{ $post->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="text-gray-700 mb-4">{{ Str::limit($post->body, 120) }}</p>
                    <div class="flex gap-4">
                        <a href="{{ route('posts.show', $post) }}" class="text-green-600 hover:underline">View</a>
                        <a href="{{ route('posts.edit', $post) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 ml-2" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                    </div>
                </div>
            @empty
                <p class="text-gray-600">You haven’t written any posts yet.</p>
            @endforelse
        </div>
    </div>

</div>
@endsection
