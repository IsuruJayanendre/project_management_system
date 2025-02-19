@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-4">Edit Project</h2>

    <form action="{{ route('projects.update', $project->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="client_name" class="block text-gray-700 font-bold mb-2">Client Name</label>
            <input type="text" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="client_name" name="client_name" value="{{ $project->client_name }}" required>
        </div>

        <div class="mb-4">
            <label for="project_type" class="block text-gray-700 font-bold mb-2">Project Type</label>
            <select class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="project_type" name="project_type_id" required>
                <option value="">Select Project Type</option>
                @foreach($projectTypes as $type)
                    <option value="{{ $type->id }}" {{ $project->project_type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="project_subcategory" class="block text-gray-700 font-bold mb-2">Project Subcategory</label>
            <select class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="project_subcategory" name="project_subcategory_id">
                <option value="">Select Subcategory</option>
                @foreach($project->projectType->subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}" {{ $project->project_subcategory_id == $subcategory->id ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="price" class="block text-gray-700 font-bold mb-2">Price</label>
            <input type="number" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="price" name="price" value="{{ $project->price }}" required>
        </div>

        <div class="mb-4">
            <label for="starting_date" class="block text-gray-700 font-bold mb-2">Starting Date</label>
            <input type="date" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="starting_date" name="starting_date" value="{{ $project->starting_date }}" required>
        </div>

        <div class="mb-4">
            <label for="note" class="block text-gray-700 font-bold mb-2">Note</label>
            <textarea class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="note" name="note">{{ $project->note }}</textarea>
        </div>

        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Update Project</button>
    </form>
</div>

<script>
    document.getElementById('project_type').addEventListener('change', function() {
        let typeId = this.value;
        let subcategorySelect = document.getElementById('project_subcategory');
        subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';

        if (typeId) {
            fetch(`/projects/get-subcategories/${typeId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(subcategory => {
                        subcategorySelect.innerHTML += `<option value="${subcategory.id}">${subcategory.name}</option>`;
                    });
                });
        }
    });
</script>
@endsection
