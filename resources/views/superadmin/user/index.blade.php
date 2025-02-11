@extends('layouts.superadmin')

@section('content')
<div class="content">
    <h1>Manage users</h1>
    <div class="text-end">
        <a href="{{ route('users.create') }}" class="btn btn-primary">Add new user</a>
    </div>
    
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach($users as $user) 
          <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->usertype }}</td>
            <td>Edit/Delete</td>
          </tr>
          @endforeach
        </tbody>
      </table>
</div>
@endsection