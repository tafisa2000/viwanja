<?php

namespace App\Http\Controllers\pos;

use Illuminate\Support\Carbon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;



class ProjectController extends Controller
{
    //
    public function AllProject()
    {
        $project = Project::latest()->get();
        return view('backend.project.project_all', compact('project'));
    }

    public function ProjectAdd()
    {

        return view('backend.project.project_add');
    }


    public function ProjectStore(Request $request)
    {
        Project::insert([
            'name' => $request->name,
            'size' => $request->size,
            'cost' => $request->cost,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Project is inserted successfuly',
            'alert-type' => 'success'
        );

        return redirect()->route('all.project')->with($notification);
    } //End method

    public function ProjectEdit($id)
    {
        $project = Project::findOrFail($id);
        return view('backend.project.project_edit', compact('project'));
    } //End method
    public function UpdateProject(Request $request)
    {

        $customer_id = $request->id;

        Project::findOrFail($customer_id)->update([
            'name' => $request->name,
            'size' => $request->size,
            'cost' => $request->cost,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Project is updated successfuly without an image',
            'alert-type' => 'success'
        );

        return redirect()->route('all.project')->with($notification);
    }

    public function ProjectDelete($id)
    {
        Project::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Project is deleted successfuly',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
