
@extends('layouts.marketing')

@section('content')
<div class="content">
    <h1 class="mb-4">Project Types</h1>
    
    <a href="{{ route('project_types.create') }}" class="btn btn-primary mb-3">Add New Project Type</a>

    @foreach($projectTypes as $type)
        <div class="card mb-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>{{ $type->name }}</h5>
                <div>
                    <a href="{{ route('project_types.edit', $type->id) }}" class="btn btn-warning btn-sm" >Edit</a>
                    <form action="{{ route('project_types.destroy', $type->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <h6>Subcategories:</h6>
                <ul>
                    @foreach($type->subcategories as $subcategory)
                        <li>{{ $subcategory->name }}

                            <a href="{{ route('subcategories.edit', $subcategory->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('subcategories.destroy', $subcategory->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this subcategory?')">Delete</button>
                            </form>
                        </li>
                    @endforeach
                </ul>

                <form action="{{ route('project_types.add_subcategory', $type->id) }}" method="POST" class="mt-3">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="name" class="form-control" placeholder="Add Subcategory" required>
                        <button type="submit" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
