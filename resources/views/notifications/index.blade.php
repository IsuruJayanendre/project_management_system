@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-xl font-semibold mb-4">Project Notifications</h2>

    @if(session('success'))
        <div class="bg-green-500 text-white p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($notifications->isEmpty())
        <p class="text-gray-500">No notifications available.</p>
    @else
        <div class="bg-white shadow-md rounded-lg p-4">
            @foreach($notifications as $notification)
                <div class="flex justify-between items-center border-b py-3">
                    <div>
                        <p class="text-gray-800">
                            📅 {{ $notification->message }} 
                        </p>
                        <span class="text-sm text-gray-500">
                            Project: <strong>{{ $notification->project->progect_name ?? 'Unknown' }}</strong> | 
                            Remain Date: <strong>{{ $notification->project->remain_date ?? 'N/A' }}</strong>
                        </span>
                    </div>
                    <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-700">
                            Delete
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $notifications->links() }} <!-- Pagination -->
        </div>
    @endif
</div>
@endsection
