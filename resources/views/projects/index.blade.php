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

{{-- this is filter option --}}
    <form method="GET" action="{{ route('projects.index') }}" class="mb-4 p-4 bg-gray-100 rounded-lg flex flex-wrap space-x-4">
        <input type="text" name="client_name" placeholder="Client Name" value="{{ request('client_name') }}" class="border p-2 rounded">
    
        <input type="text" name="company" placeholder="Company" value="{{ request('company') }}" class="border p-2 rounded">
    
        <select name="project_type_id" class="border p-2 rounded">
            <option value="">All Types</option>
            @foreach($projectTypes as $type)
                <option value="{{ $type->id }}" {{ request('project_type_id') == $type->id ? 'selected' : '' }}>
                    {{ $type->name }}
                </option>
            @endforeach
        </select>
    
        <input type="date" name="starting_date" value="{{ request('starting_date') }}" class="border p-2 rounded">
    
        <select name="status" class="border p-2 rounded">
            <option value="">All Status</option>
            <option value="not_complete" {{ request('status') == 'not_complete' ? 'selected' : '' }}>Not Complete</option>
            <option value="complete" {{ request('status') == 'complete' ? 'selected' : '' }}>Complete</option>
        </select>
    
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">Filter</button>
        <a href="{{ route('projects.index') }}" class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded">Reset</a>
    </form>
    

   {{-- this is table --}}

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">Client Name</th>
                    <th class="px-4 py-2 border">Company</th>
                    <th class="px-4 py-2 border">Project Type</th>
                    <th class="px-4 py-2 border">Subcategory</th>
                    <th class="px-4 py-2 border">Price</th>
                    <th class="px-4 py-2 border">Starting Date</th>
                    <th class="px-4 py-2 border">Remain Date</th>
                    <th class="px-4 py-2 border">Note</th>
                    <th class="px-4 py-2 border">User</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $key => $project)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="px-4 py-2 border">{{ $key + 1 }}</td>
                        <td class="px-4 py-2 border">{{ $project->client_name }}</td>
                        <td class="px-4 py-2 border">{{ $project->company }}</td>
                        <td class="px-4 py-2 border">{{ $project->projectType->name }}</td>
                        <td class="px-4 py-2 border">{{ $project->projectSubcategory->name ?? 'N/A' }}</td>
                        <td class="px-4 py-2 border">{{ number_format($project->price, 2) }}</td>
                        <td class="px-4 py-2 border">{{ $project->starting_date }}</td>
                        <td class="px-4 py-2 border">{{ $project->remain_date }}</td>
                        <td class="px-4 py-2 border">{{ $project->note }}</td>
                        <td class="px-4 py-2 border">{{ $project->user->name }}</td>
                        <td class="px-4 py-2 border">
                            <form action="{{ route('projects.toggleStatus', $project->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="{{ $project->status === 'not_complete' ? 'bg-red-500' : 'bg-green-500' }} hover:bg-opacity-75 text-white font-bold py-1 px-2 rounded text-sm">
                                    {{ $project->status === 'not_complete' ? 'Not Complete' : 'Complete' }}
                                </button>
                            </form>
                        </td>
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
