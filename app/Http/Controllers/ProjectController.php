<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectType;
use App\Models\ProjectSubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // 
    public function index(Request $request)
{
    $query = Project::with(['projectType', 'projectSubcategory']);

    if ($request->filled('client_name')) {
        $query->where('client_name', 'like', '%' . $request->client_name . '%');
    }

    if ($request->filled('company')) {
        $query->where('company', 'like', '%' . $request->company . '%');
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    if ($request->filled('project_type_id')) {
        $query->where('project_type_id', $request->project_type_id);
    }

    if ($request->filled('starting_date')) {
        $query->whereDate('starting_date', $request->starting_date);
    }

    $projects = $query->paginate(10);
    $projectTypes = ProjectType::all();

    return view('projects.index', compact('projects', 'projectTypes'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projectTypes = ProjectType::with('subcategories')->get();
        return view('projects.create', compact('projectTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'project_type_id' => 'required|exists:project_types,id',
            'project_subcategory_id' => 'nullable|exists:project_subcategories,id',
            'price' => 'required|numeric',
            'starting_date' => 'required|date',
            'remain_date' => 'nullable|date',
            'note' => 'nullable|string',
        ]);

        

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'not_complete';

        try {
            // Create project
            $project = Project::create($validated);
    
            if ($project) {
                return redirect()->route('projects.create')->with('success', 'Project added successfully!');
            } else {
                return back()->with('error', 'Failed to create project. Please try again.')->withInput();
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $projectTypes = ProjectType::with('subcategories')->get();
        return view('projects.edit', compact('project', 'projectTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'project_type_id' => 'required|exists:project_types,id',
            'project_subcategory_id' => 'nullable|exists:project_subcategories,id',
            'price' => 'required|numeric',
            'starting_date' => 'required|date',
            'remain_date' => 'nullable|date',
            'note' => 'nullable|string',
        ]);

        $project = Project::findOrFail($id);
        $project->update($validated);

        return redirect()->route('projects.index')->with('success', 'Project updated successfully!');
    
    }
    public function toggleStatus($id)
    {
        $project = Project::findOrFail($id);
        $project->status = $project->status === 'not_complete' ? 'complete' : 'not_complete';
        $project->save();

        return redirect()->route('projects.index')->with('success', 'Project status updated successfully!');
    }
    
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        try {
            $project->delete();
            return redirect()->route('projects.index')->with('success', 'Project deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
