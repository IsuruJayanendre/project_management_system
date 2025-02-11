@extends('layouts.superadmin')

@section('content')
<div class="content">
    <h1>Create user</h1>
    <div class="container p-5">
        <form action="{{ route('users.store') }}" method="POST" class="py-14">
            @csrf
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">User name</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="name">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Phone</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="phone">
          </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="password">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password_confirmation">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Select User role</label>
          <select class="form-select" aria-label="Default select example" name="role">
            <option value="marketing">Marketting</option>
            <option value="user">User</option>
          </select>
        </div>
        <div class="text-end">
        <button type="submit" class="btn btn-primary">Register user</button>
        </div>
      </form>
    </div>
</div>
@endsection