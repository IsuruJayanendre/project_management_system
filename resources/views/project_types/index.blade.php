
@extends('layouts.dashboard')

@section('content')
<div class="content">
    
    <div class="text-end">
        <a href="javascript:void(0)" 
   onclick="openModal()"
   class="text-white bg-blue-900 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-900 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    Add New Project Type
</a>
    </div><br>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

        <table class="w-full text-sm text-left rtl:text-right text-white dark:text-white">
            <thead class="text-xs text-white uppercase bg-blue-900 dark:bg-blue-900 dark:white">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Sub categories
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <span class="sr-only">Edit</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($projectTypes as $type)
                    
                
                <tr class="bg-white border-b dark:bg-white dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-200">
                    <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap dark:black">
                        {{ $type->id }}
                    </th>
                    <td class="px-6 py-4 text-black">
                        {{ $type->name }}
                    </td>
                    <td class="px-6 py-4 text-black">
                        @foreach($type->subcategories as $subcategory)
                        <ul>
                            <li>{{ $subcategory->name }}</li>
                        </ul>
                        
                        @endforeach
                    </td>
                    
                    <td class="px-6 py-4 text-right">
                        <button type="button" class="text-white bg-blue-800 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add subcategory</button>
                        <button type="button" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Edit</button>
                        <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

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

<div id="modal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
        <h2 class="text-xl font-bold mb-4">Add New Project Type</h2>

        <!-- Form inside modal -->
        <form action="{{ route('project_types.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Project Type Name</label>
                <input type="text" name="name" required 
                       class="mt-1 p-2 w-full border rounded-md focus:ring focus:ring-blue-300">
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeModal()" 
                        class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }
</script>

@endsection
