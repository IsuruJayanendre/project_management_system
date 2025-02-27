@extends('layouts.dashboard')

@section('content')

<div class="text-end">
    <a href="javascript:void(0)" 
        onclick="openModal()"
        class="bg-blue-900 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Add New sub Category
    </a>
</div><br>

<div class="overflow-x-auto">

    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2 border">
                    Main category
                </th>
                {{-- <th class="px-4 py-2 border">
                    ID
                </th> --}}
                <th class="px-4 py-2 border">
                    Sub category
                </th>
                
                <th class="px-4 py-2 border">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($sub_types as $projectTypeId => $subCategories)
                @php
                    $mainCategory = $subCategories->first()->projectType;
                @endphp
        
                @foreach($subCategories as $index => $subcategory)
                    <tr class="border-b hover:bg-gray-100">
                        <!-- Show Main Category Name Only in First Row -->
                        @if ($index === 0)
                            <td class="px-4 py-2 border font-bold text-center" rowspan="{{ count($subCategories) }}">
                                {{ $mainCategory->name }}
                            </td>
                        @endif
        
                        <!-- Subcategory Details -->
                        {{-- <td class="px-4 py-2 border">
                            {{ $subcategory->id }}
                        </td> --}}
                        <td class="px-4 py-2 border">
                            {{ $subcategory->name }}
                        </td>
        
                        <!-- Action Buttons -->
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <!-- Edit Button -->
                                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-4 rounded">
                                    Edit
                                </button>
        
                                <!-- Delete Button -->
                                <form action="{{ route('subcategories.destroy', $subcategory->id) }}" method="POST" class="delete-form">
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
            @endforeach
        </tbody>
        
    </table>
</div>
<!--insert model-->
<div id="modal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
        <h2 class="text-xl font-bold mb-4">Add New Sub Category</h2>

        <!-- Form inside modal -->
        <form action="{{ route('add.subCategory') }}" method="POST">
            @csrf
            <div class="mb-4">
                <select class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" aria-label="Default select example" name="category_id">
                    @foreach( $types as $type)
                    <option value="{{ $type->id}}">{{ $type->name }}</option>
                    @endforeach
                  </select>
            </div>
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