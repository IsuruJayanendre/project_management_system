@extends('layouts.dashboard')

@section('content')

<div class="text-end">
    <a href="{{ route('users.create') }}" class="text-white bg-blue-900 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-900 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        Create user
    </a>
</div><br>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">

    <table class="w-full text-sm text-left rtl:text-right text-white dark:text-white">
        <thead class="text-xs text-white uppercase bg-gray-50 dark:bg-blue-900 dark:white">
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
                    <button type="button" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Edit</button>
                    <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection