@extends('layouts.dashboard')

@section('content')

<div class="text-end">
    <a href="{{ route('users.create') }}" class="bg-blue-900 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Create user
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
                    username
                </th>
                <th class="px-4 py-2 border">
                    email
                </th>
                <th class="px-4 py-2 border">
                    phone
                </th>
                <th class="px-4 py-2 border">
                    role
                </th>
                <th class="px-4 py-2 border">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            @if ($user->usertype != 'superadmin')
                <tr class="border-b hover:bg-gray-100">
                    <td class="px-4 py-2 border">
                        {{ $user->id }}
                    </td>
                    <td class="px-4 py-2 border">
                        {{ $user->name }}
                    </td>
                    <td class="px-4 py-2 border">
                        {{ $user->email }}
                    </td>
                    <td class="px-4 py-2 border">
                        {{ $user->phone }}
                    </td>
                    <td class="px-4 py-2 border">
                        <span 
                            class="px-2 py-1 rounded 
                            @if ($user->usertype == 'marketing') 
                                bg-yellow-200 
                            @elseif ($user->usertype == 'user') 
                                bg-blue-200  
                            @else 
                                bg-gray-500 text-white 
                            @endif">
                            {{ $user->usertype }}
                        </span>
                    </td>
                <td class="px-4 py-2 border">
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
            @endif
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