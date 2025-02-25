@extends('layouts.dashboard')

@section('content')
<div class="content">
    <div class="container mx-auto p-6">
        <form action="{{ route('users.store') }}" method="POST" class="max-w-sm mx-auto p-4 rounded-lg">
            @csrf
        <div class="mb-3">
            <label for="exampleInputPassword1" class="block mb-2 text-sm font-medium text-gray-900">User name</label>
            <input type="text" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" id="exampleInputPassword1" name="name">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="block mb-2 text-sm font-medium text-gray-900">Phone</label>
            <input type="text" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" id="exampleInputPassword1" name="phone">
          </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="block mb-2 text-sm font-medium text-gray-900">Email address</label>
          <input type="email" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
          <input type="password" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" id="exampleInputPassword1" name="password">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="block mb-2 text-sm font-medium text-gray-900">Confirm Password</label>
            <input type="password" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" id="exampleInputPassword1" name="password_confirmation">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="block mb-2 text-sm font-medium text-gray-900">Select User role</label>
          <select class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" aria-label="Default select example" name="role">
            <option value="user">User</option>
            @if(Auth::user()->usertype !== 'marketing')
            <option value="marketing">Marketting</option>
            @endif
          </select>
        </div>
        <div class="text-end">
          <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Cancel
        </a>&nbsp
        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Register user</button>
        </div>
      </form>
    </div>
</div>
@endsection