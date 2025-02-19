@extends('layouts.dashboard')

@section('content')



<div class="relative overflow-x-auto shadow-md sm:rounded-lg">

    <table class="w-full text-sm text-left rtl:text-right text-white dark:text-white">
        <thead class="text-xs text-white uppercase bg-blue-900 dark:bg-blue-900 dark:white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Product name
                </th>
                <th scope="col" class="px-6 py-3">
                    Color
                </th>
                <th scope="col" class="px-6 py-3">
                    Category
                </th>
                <th scope="col" class="px-6 py-3">
                    Price
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b dark:bg-white dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap dark:black">
                    Apple MacBook Pro 17"
                </th>
                <td class="px-6 py-4 text-black">
                    Silver
                </td>
                <td class="px-6 py-4 text-black">
                    Laptop
                </td>
                <td class="px-6 py-4 text-black">
                    $2999
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-white dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap dark:black">
                    Apple MacBook Pro 17"
                </th>
                <td class="px-6 py-4 text-black">
                    Silver
                </td>
                <td class="px-6 py-4 text-black">
                    Laptop
                </td>
                <td class="px-6 py-4 text-black">
                    $2999
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-white dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-black whitespace-nowrap dark:black">
                    Apple MacBook Pro 17"
                </th>
                <td class="px-6 py-4 text-black">
                    Silver
                </td>
                <td class="px-6 py-4 text-black">
                    Laptop
                </td>
                <td class="px-6 py-4 text-black">
                    $2999
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>

@endsection