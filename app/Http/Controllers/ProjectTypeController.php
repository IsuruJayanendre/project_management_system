<?php

namespace App\Http\Controllers;

use App\Models\ProjectType;
use App\Models\ProjectSubcategory;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class ProjectTypeController extends Controller
{
    public function index()
    {
        $projectTypes = ProjectType::with('subcategories')->get();
        return view('project_types.index', compact('projectTypes'));
    }

    public function subCategory()
    {
        $types = ProjectType::all();
        
        // Group subcategories by project_type_id
        $sub_types = ProjectSubcategory::all()->groupBy('project_type_id');

        return view('project_types.sub_types', compact('sub_types', 'types'));
    }


    public function create()
    {
        return view('project_types.create');
    }

    public function store(Request $request)
    {
        try{
        $data = $request->validate(['name' => 'required|string|max:255']);
        ProjectType::create($data);

            Alert::success('Success', 'Category created successfully!');
        }catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong!');
        }
        return redirect()->back();
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
        try{
        $projectType = ProjectType::findOrFail($id);
        $projectType->delete();

            Alert::success('Success', 'Category deleted successfully!');
        }catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong!');
        }
        return redirect()->back();
    }

    public function addSubcategory(Request $request, $id)
    {
        try{
        $data = $request->validate(['name' => 'required|string|max:50']);
        ProjectSubcategory::create(['name' => $data['name'], 'project_type_id' => $id]);
        
            Alert::success('Success', 'Subcategory deleted successfully!');
        }catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong!');
        }
        return redirect()->back();
    }

    public function addSub(Request $request){

        try{
        $request->validate([
            'category_id' => 'required|string|max:50',
            'name' => 'required|string|max:50',
            
        ]);
        ProjectSubcategory::create([
            'project_type_id' => $request->category_id,
            'name' => $request->name,
            
            ]);
            Alert::success('Success', 'Subcategory added successfully!');
        }catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong!');
        }
        return redirect()->back();
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
        try{
        $subcategory = ProjectSubcategory::findOrFail($id);
        $subcategory->delete();
        Alert::success('Success', 'Subcategory deleted successfully!');
        }catch (\Exception $e) {
            Alert::error('Error', 'Something went wrong!');
        }
        return redirect()->back();
    }
}
