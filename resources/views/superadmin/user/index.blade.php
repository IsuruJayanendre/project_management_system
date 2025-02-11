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
          <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            <td>@mdo</td>
          </tr>
        </tbody>
      </table>
</div>
@endsection