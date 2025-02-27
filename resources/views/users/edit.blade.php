@extends('layouts.dashboard')

@section('content')

<div class="content">
    <div class="container p-5">
        <form action="{{ route('users.update', $user->id) }}" method="POST" class="max-w-sm mx-auto p-4 rounded-lg">
            @csrf
            @method('PUT') <!-- Required for updating -->
        
            <div class="mb-3">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900">User Name</label>
                <input type="text" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" id="name" name="name" value="{{ old('name', $user->name) }}">
            </div>
        
            <div class="mb-3">
                <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Phone</label>
                <input type="text" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
            </div>
        
            <div class="mb-3">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email Address</label>
                <input type="email" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" id="email" name="email" value="{{ old('email', $user->email) }}">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
        
            <div class="mb-3">
                <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Select User Role</label>
                <select class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" id="role" name="role">
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                    @if(Auth::user()->usertype !== 'marketing')
                        <option value="marketing" {{ $user->role == 'marketing' ? 'selected' : '' }}>Marketing</option>
                    @endif
                </select>
            </div>
        
            <div class="text-end">
                <a href="{{ route('users.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700">
                    Cancel
                </a>&nbsp;
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700">
                    Update User
                </button>
            </div>
        </form>
        
    </div>
</div>

@endsection