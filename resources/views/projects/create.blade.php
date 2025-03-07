@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-4">Create New Project</h2>

    <form action="{{ route('projects.store') }}" method="POST" class="bg-white p-6 rounded-lg">
        @csrf
    
        <div class="grid grid-cols-2 gap-6">
            <!-- Left Section (General Project Details) -->
            <div>
                <div class="mb-4">
                    <label for="client_name" class="block text-gray-700 font-bold mb-2">Client Name</label>
                    <input type="text" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="client_name" name="client_name" required>
                </div>
    
                <div class="mb-4">
                    <label for="project_name" class="block text-gray-700 font-bold mb-2">Project Name</label>
                    <input type="text" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="project_name" name="project_name" required>
                </div>
    
                <div class="mb-4">
                    <label for="company" class="block text-gray-700 font-bold mb-2">Company</label>
                    <input type="text" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="company" name="company" required>
                </div>
    
                <div class="mb-4">
                    <label for="project_type_id" class="block text-gray-700 font-bold mb-2">Project Type</label>
                    <select class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="project_type_id" name="project_type_id" required>
                        <option value="">Select Project Type</option>
                        @foreach($projectTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="mb-4">
                    <label for="project_subcategory_id" class="block text-gray-700 font-bold mb-2">Project Subcategory</label>
                    <select class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="project_subcategory_id" name="project_subcategory_id">
                        <option value="">Select Subcategory</option>
                        @foreach($projectTypes as $type)
                            <optgroup label="{{ $type->name }}">
                                @foreach($type->subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
    
                <div class="mb-4">
                    <label for="starting_date" class="block text-gray-700 font-bold mb-2">Starting Date</label>
                    <input type="date" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="starting_date" name="starting_date" required>
                </div>
    
                <div class="mb-4">
                    <label for="remain_date" class="block text-gray-700 font-bold mb-2">Remaining Date</label>
                    <input type="date" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="remain_date" name="remain_date" required>
                </div>
    
                <div class="mb-4">
                    <label for="note" class="block text-gray-700 font-bold mb-2">Note</label>
                    <textarea class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="note" name="note"></textarea>
                </div>
            </div>
    
            <!-- Right Section (Price Details) -->
            <div class="bg-gray-100 p-6 rounded-lg">
                <h2 class="text-lg font-bold mb-4">Pricing Details</h2>
    
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Hosting Price</label>
                    <input type="number" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="host" name="host" required oninput="calculateCost()">
                </div>
    
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Advance</label>
                    <input type="number" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="advance" name="advance" required oninput="calculateCost()">
                </div>
    
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Pages</label>
                    <input type="number" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="page" name="page" required oninput="calculateCost()">
                </div>
    
                <hr class="my-4">
    
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Total Cost</label>
                    <input type="number" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-200" id="total" name="total" readonly>
                </div>
    
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Balance</label>
                    <input type="number" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-200" id="balance" name="balance" readonly>
                </div>
            </div>
        </div>
    
        <!-- Buttons (Aligned at the Bottom) -->
        <div class="text-end mt-6">
            <a href="{{ route('projects.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Cancel
            </a>&nbsp;
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Create Project
            </button>
        </div>
    </form>
    @if(session('success'))
    <div class="bg-green-400 text-white p-3 rounded">
        {{ session('success') }}
    </div>
@endif

<script>
    function calculateCost() {
        let host = parseFloat(document.getElementById("host").value) || 0;
        let advance = parseFloat(document.getElementById("advance").value) || 0;
        let pages = parseInt(document.getElementById("page").value) || 0;

        let totalCost = host + (pages * 1000);
        let balance = totalCost - advance;

        document.getElementById("total").value = totalCost;
        document.getElementById("balance").value = balance;
    }
</script>

</div>
@endsection
