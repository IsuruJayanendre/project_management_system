@extends('layouts.dashboard')

@section('content')

<div class="text-end">
    <a href="{{ route('users.create') }}" class="bg-blue-900 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Create user
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
                    username
                </th>
                <th scope="col" class="px-6 py-3">
                    email
                </th>
                <th scope="col" class="px-6 py-3">
                    phone
                </th>
                <th scope="col" class="px-6 py-3">
                    role
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $users as $user )
                
            
            <tr class="bg-white border-b dark:bg-white dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap dark:black">
                    {{ $user->id }}
                </th>
                <td class="px-6 py-4 text-black">
                    {{ $user->name }}
                </td>
                <td class="px-6 py-4 text-black">
                    {{ $user->email }}
                </td>
                <td class="px-6 py-4 text-black">
                    {{ $user->phone }}
                </td>
                <td class="px-6 py-4 text-black">
                    {{ $user->usertype }}
                </td>
                <td class="px-6 py-4 text-right">
                    <div class="flex items-center space-x-2">
                        <!-- Edit Button -->
                        <a href="{{ route('users.edit', $user->id) }}" 
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-4 rounded">
                            Edit
                        </a>
                
                        <!-- Delete Button -->
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="delete-form">
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