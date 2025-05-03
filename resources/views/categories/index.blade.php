@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Manage Categories</h1>

    <a href="{{ route('categories.create') }}" class="bg-blue-700 text-white px-4 py-2 rounded mb-4 inline-block">Add New Category</a>

    <ul>
        @foreach ($categories as $category)
            <li class="flex justify-between mb-2">
                <span>{{ $category->name }}</span>
                <div>
                    <a href="{{ route('categories.edit', $category) }}" class="text-blue-500">Edit</a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 ml-2">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endsection
