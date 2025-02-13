<?php

namespace App\Http\Controllers;

use App\Models\ProjectType;
use App\Models\ProjectSubcategory;
use Illuminate\Http\Request;

class ProjectTypeController extends Controller
{
    public function index()
    {
        $projectTypes = ProjectType::with('subcategories')->get();
        return view('project_types.index', compact('projectTypes'));
    }

    public function create()
    {
        return view('project_types.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required|string|max:255']);
        ProjectType::create($data);
        return redirect()->route('project_types.index');
    }

    public function edit($id)
    {
        $projectType = ProjectType::findOrFail($id);
        return view('project_types.edit', compact('projectType'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate(['name' => 'required|string|max:255']);
        $projectType = ProjectType::findOrFail($id);
        $projectType->update($data);
        return redirect()->route('project_types.index')->with('success', 'Project Type Updated Successfully');
    }

    public function destroy($id)
    {
        $projectType = ProjectType::findOrFail($id);
        $projectType->delete();
        return redirect()->route('project_types.index')->with('success', 'Project Type Deleted Successfully');
    }

    public function addSubcategory(Request $request, $id)
    {
        $data = $request->validate(['name' => 'required|string|max:255']);
        ProjectSubcategory::create(['name' => $data['name'], 'project_type_id' => $id]);
        return redirect()->route('project_types.index')->with('success', 'Subcategory Added Successfully');
    }
    public function editSubcategory($id)
    {
        $subcategory = ProjectSubcategory::findOrFail($id);
        return view('project_types.edit_subcategory', compact('subcategory'));
    }

    public function updateSubcategory(Request $request, $id)
    {
        $data = $request->validate(['name' => 'required|string|max:255']);
        $subcategory = ProjectSubcategory::findOrFail($id);
        $subcategory->update($data);
        return redirect()->route('project_types.index')->with('success', 'Subcategory Updated Successfully');
    }

    public function destroySubcategory($id)
    {
        $subcategory = ProjectSubcategory::findOrFail($id);
        $subcategory->delete();
        return redirect()->route('project_types.index')->with('success', 'Subcategory Deleted Successfully');
    }
}
