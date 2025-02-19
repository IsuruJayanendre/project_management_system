@extends('layouts.dashboard')

@section('content')

<div class="text-end">
    <a href="javascript:void(0)" 
        onclick="openModal()"
        class="text-white bg-blue-900 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-900 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Add New sub Category
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
                    Main category
                </th>
                <th scope="col" class="px-6 py-3">
                    Sub category
                </th>
                
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($sub_types as $subcategory)
            <tr class="bg-white border-b dark:bg-white dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-200">
                
                <td class="px-6 py-4 text-black">
                    {{ $subcategory->id }}
                </td>
                <td class="px-6 py-4 text-black">
                    {{ $subcategory->name }}
                </td>
                <td class="px-6 py-4 text-black">
                    {{ $subcategory->projectType->name }}
                </td>
                
                <td class="px-6 py-4 text-right">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                </td>
            </tr>
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