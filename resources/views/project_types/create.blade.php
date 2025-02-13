@extends('layouts.marketing')

@section('content')
<div class="content">
    <h1>Add New Project Type</h1>

    <form action="{{ route('project_types.store') }}" method="POST" class="mt-3">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Project Type Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter project type name" required>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('project_types.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
