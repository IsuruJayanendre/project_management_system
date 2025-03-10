
@extends('layouts.dashboard')

@section('content')
<div class="content">
    
    <div class="text-end">
        <a href="javascript:void(0)" 
            onclick="openModal()"
            class="bg-blue-900 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add New Project Type
        </a>
    </div><br>
    <div class="overflow-x-auto">

        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 border">
                        #
                    </th>
                    <th class="px-4 py-2 border">
                        Category
                    </th>
                    
                    <th class="px-4 py-2 border">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($projectTypes as $type)
                    
                
                <tr class="border-b hover:bg-gray-100">
                    <td class="px-4 py-2 border">
                        {{ $type->id }}
                    </td>
                    <td class="px-4 py-2 border">
                        {{ $type->name }}
                    </td>
                    
                    
                    <td class="px-4 py-2 border">
                        <div class="flex justify-end gap-2">
                            <!-- Edit Button -->
                            <button @click="openEditModal({{ $type }})"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-4 rounded">
                                Edit
                            </button>
                    
                            <!-- Delete Button -->
                            <form action="{{ route('project_types.destroy', $type->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded delete-btn">
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
<!--insert model-->
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
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700">
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

<script>
    function openEditModal(projectType) {
        let modalScope = document.querySelector('[x-data]').__x;
        modalScope.projectType = projectType;
        modalScope.showEditModal = true;
    }
</script>


<!-- SweetAlert Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".delete-btn").forEach(button => {
            button.addEventListener("click", function () {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.closest("form").submit();
                    }
                });
            });
        });
    });
</script>

@endsection
