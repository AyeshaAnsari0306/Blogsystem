@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit User Roles</h1>

    <form method="POST" action="{{ route('users.update', $user) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold">Name</label>
            <input type="text" value="{{ $user->name }}" class="w-full p-2 border" disabled>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Assign Roles</label>
            @foreach($roles as $role)
                <div>
                    <label>
                        <input type="checkbox" name="roles[]" value="{{ $role }}" {{ $user->hasRole($role) ? 'checked' : '' }}>
                        {{ $role }}
                    </label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>
@endsection
