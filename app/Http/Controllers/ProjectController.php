<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectType;
use App\Models\ProjectSubcategory;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with(['projectType', 'projectSubcategory'])->paginate(10);
        return view('projects.index', compact('projects'));
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
            'project_type_id' => 'required|exists:project_types,id',
            'project_subcategory_id' => 'nullable|exists:project_subcategories,id',
            'price' => 'required|numeric',
            'starting_date' => 'required|date',
            'note' => 'nullable|string',
        ]);

        Project::create($validated);

        return redirect()->route('projects.create')->with('success', 'Project added successfully!');
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
            'project_type_id' => 'required|exists:project_types,id',
            'project_subcategory_id' => 'nullable|exists:project_subcategories,id',
            'price' => 'required|numeric',
            'starting_date' => 'required|date',
            'note' => 'nullable|string',
        ]);

        $project = Project::findOrFail($id);
        $project->update($validated);

        return redirect()->route('projects.index')->with('success', 'Project updated successfully!');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
