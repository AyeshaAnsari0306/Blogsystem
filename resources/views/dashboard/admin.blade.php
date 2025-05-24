@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Admin Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-xl font-semibold text-gray-700">Total Posts</h2>
            <p class="text-2xl font-bold mt-2">{{ $postCount }}</p>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-xl font-semibold text-gray-700">Total Comments</h2>
            <p class="text-2xl font-bold mt-2">{{ $commentsCount }}</p>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-xl font-semibold text-gray-700">Users by Role</h2>
            <ul class="mt-2 text-sm space-y-1">
                @foreach ($userRoles as $role)
                    <li class="flex justify-between">
                        <span>{{ $role->name }}</span>
                        <span class="font-bold">{{ $role->users_count }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="bg-white p-4 rounded shadow">
        <h2 class="text-xl font-semibold text-gray-700 mb-2">Recent Posts</h2>
        <ul class="list-disc ml-6 space-y-1 text-gray-600">
            @foreach ($recentPosts as $post)
                <li>{{ $post->title }} <span class="text-sm text-gray-400">({{ $post->created_at->format('M d, Y') }})</span></li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
