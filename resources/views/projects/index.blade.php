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

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-white dark:text-white">
            <thead class="text-xs text-white uppercase bg-blue-900 dark:bg-blue-900 dark:white">
                <tr>
                    <th scope="col" class="px-6 py-3">#</th>
                    <th scope="col" class="px-6 py-3">Client Name</th>
                    <th scope="col" class="px-6 py-3">Project Type</th>
                    <th scope="col" class="px-6 py-3">Subcategory</th>
                    <th scope="col" class="px-6 py-3">Price</th>
                    <th scope="col" class="px-6 py-3">Starting Date</th>
                    <th scope="col" class="px-6 py-3">Note</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $key => $project)
                    <tr class="bg-white border-b dark:bg-white dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-200">
                        <td class="px-6 py-4 text-black">{{ $key + 1 }}</td>
                        <td class="px-6 py-4 text-black">{{ $project->client_name }}</td>
                        <td class="px-6 py-4 text-black">{{ $project->projectType->name }}</td>
                        <td class="px-6 py-4 text-black">{{ $project->projectSubcategory->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-black">{{ number_format($project->price, 2) }}</td>
                        <td class="px-6 py-4 text-black">{{ $project->starting_date }}</td>
                        <td class="px-6 py-4 text-black">{{ $project->note }}</td>
                        <td class="px-6 py-4 text-black">
                            <div class="flex items-center space-x-2">
                            <a href="{{ route('projects.edit', $project->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-4 rounded">Edit</a>
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded">Delete</button>
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
@endsection
