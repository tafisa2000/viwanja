<?php

namespace App\Http\Controllers\pos;

use App\Http\Controllers\Controller;
use App\Models\Project;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;



class CategoryController extends Controller
{
    //
    public function AllCategory()
    {
        $category = Category::latest()->get();
        return view('backend.category.category_all', compact('category'));
    }
    //
    public function AddCategory()
    {
        $project = Project::all();
        $category = Category::all();
        return view('backend.category.category_add', compact('category', 'project'));
    }

    public function StoreProjectCategory(Request $request)
    {
        Category::insert([
            'name' => $request->name,
            'price' => $request->price,
            'project_id' => $request->project_id,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Project is inserted successfuly',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);
    } //End method

    public function ProjectCategoriesEdit($id)
    {
        $category = Category::findOrFail($id);
        $project = Project::findOrFail($category->project_id);
        return view('backend.category.category_edit', compact('category', 'project'));
    } // End method


    public function DeleteCategory($id)
    {
        Category::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Project is deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
