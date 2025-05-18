@extends('layouts.app')

@section('content')

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1>

    <p>Recent Posts:</p>
    <ul class="list-disc ml-6">
        @foreach ($recentPosts as $post)
            <li>{{ $post->title }}</li>
        @endforeach
    </ul>

    <div class="mt-4">
        <p><strong>Total Posts:</strong> {{ $postCount }}</p>
        <p><strong>Users by Role:</strong></p>
        <ul class="list-disc ml-6">
            @foreach ($userRoles as $role)
                <li>{{ $role->name }}: {{ $role->users_count }}</li>
            @endforeach
        </ul>
        <p><strong>Comments:</strong> {{ $commentsCount }}</p>
    </div>
</div>
@endsection
