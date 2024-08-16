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
        // Remove commas and convert the price to a numeric value
        $price = str_replace(",", "", $request->price);
        $price = (float) $price;

        Category::insert([
            'name' => $request->name,
            'price' => $price,
            'project_id' => $request->project_id,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Project Category inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);
    }


    public function ProjectCategoriesEdit($id)
    {
        $category = Category::findOrFail($id);
        $projects = Project::all(); // Fetch all projects to populate the dropdown
        return view('backend.category.category_edit', compact('category', 'projects'));
    }

    public function ProjectCategoriesUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'project_id' => ['required', 'exists:projects,id'],
        ]);

        $category = Category::findOrFail($id);

        // Remove commas from price and convert to a float
        $price = str_replace(",", "", $request->price);
        $price = (float) $price;

        $category->name = $request->name;
        $category->price = $price;
        $category->project_id = $request->project_id;

        $category->save();

        $notification = array(
            'message' => 'Category updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.category')->with($notification);
    }




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
