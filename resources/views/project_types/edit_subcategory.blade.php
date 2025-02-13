@extends('layouts.marketing')

@section('content')
<div class="content">
    <h1>Edit Subcategory</h1>

    <form action="{{ route('subcategories.update', $subcategory->id) }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Subcategory Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $subcategory->name }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('project_types.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
