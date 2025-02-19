@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-4">Project List</h2>
    <a href="{{ route('projects.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Add New Project</a>

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
                            <a href="{{ route('projects.edit', $project->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded text-sm">Edit</a>
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-sm">Delete</button>
                            </form>
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
@endsection
