@extends('layouts.dashboard')

@section('content')



<div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white p-6">
    <!-- Page Title -->
    <h2 class="text-2xl font-semibold mb-4">Dashboard</h2>

    <!-- Summary Cards -->
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-blue-500 text-white p-4 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold">📂 Total Projects</h3>
            <p class="text-2xl font-bold">{{ $projectCount }}</p>
        </div>
        <div class="bg-green-500 text-white p-4 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold">👤 Total Users</h3>
            <p class="text-2xl font-bold">{{ $userCount }}</p>
        </div>
        <div class="bg-yellow-500 text-white p-4 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold">🔔 Notifications</h3>
            <p class="text-2xl font-bold">5</p>
        </div>
    </div>

    <!-- Recent Projects Table -->
    <div class="mt-6">
        <h3 class="text-xl font-semibold mb-3">Recent Projects</h3>
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs uppercase bg-gray-100">
                <tr>
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Project Name</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b hover:bg-gray-100">
                    <td class="px-4 py-2">1</td>
                    <td class="px-4 py-2">Website Redesign</td>
                    <td class="px-4 py-2 text-green-600 font-semibold">Completed</td>
                    <td class="px-4 py-2">
                        <button class="bg-blue-500 text-white px-3 py-1 rounded">View</button>
                    </td>
                </tr>
                <tr class="border-b hover:bg-gray-100">
                    <td class="px-4 py-2">2</td>
                    <td class="px-4 py-2">Mobile App Development</td>
                    <td class="px-4 py-2 text-yellow-600 font-semibold">In Progress</td>
                    <td class="px-4 py-2">
                        <button class="bg-blue-500 text-white px-3 py-1 rounded">View</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


@endsection