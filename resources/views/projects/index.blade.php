@extends('layouts.dashboard')

@section('content')

<div class="text-end">
    <a href="{{ route('projects.create') }}" class="bg-blue-900 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Add New Project
    </a>
</div><br>


    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">Client Name</th>
                    <th class="px-4 py-2 border">Project Type</th>
                    <th class="px-4 py-2 border">Subcategory</th>
                    <th class="px-4 py-2 border">Price</th>
                    <th class="px-4 py-2 border">Starting Date</th>
                    <th class="px-4 py-2 border">Note</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $key => $project)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="px-4 py-2 border">{{ $key + 1 }}</td>
                        <td class="px-4 py-2 border">{{ $project->client_name }}</td>
                        <td class="px-4 py-2 border">{{ $project->projectType->name }}</td>
                        <td class="px-4 py-2 border">{{ $project->projectSubcategory->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2 border">{{ number_format($project->price, 2) }}</td>
                        <td class="px-4 py-2 border">{{ $project->starting_date }}</td>
                        <td class="px-4 py-2 border">{{ $project->note }}</td>
                        <td class="px-4 py-2 border flex space-x-2">
                            <a href="{{ route('projects.edit', $project->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-4 rounded">Edit</a>
                            <form id="delete-form-{{ $project->id }}" action="{{ route('projects.destroy', $project->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded delete-btn"
                                    onclick="confirmDelete({{ $project->id }})">
                                    Delete
                                </button>
                            </form>
                            
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $projects->links() }}
    </div>
</div>

<script>
    function confirmDelete(projectId) {
        Swal.fire({
            title: "Are you sure?",
            text: "This action cannot be undone!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${projectId}`).submit();
            }
        });
    }
</script>

@endsection
