<?php

namespace App\Http\Controllers\pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Plot;
use App\Models\Invoice;
use App\Models\InvoiceDetail;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;



class PlotsController extends Controller
{
    //
    public function AllPlots()
    {
        $plots = Plot::latest()->get();
        return view('backend.plots.plots_all', compact('plots'));
    }
    public function PlotAdd()
    {
        $project = Project::all();
        $category = Category::all();
        return view('backend.plots.plots_add', compact('project', 'category'));
    }


    public function PlotStore(Request $request)
    {
        Plot::create([
            'name' => $request->name,
            'size' => $request->size,
            'project_id' => $request->project_id,
            'category_id' => $request->category_id,
            'created_by' => Auth::id(),
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Project is inserted successfuly',
            'alert-type' => 'success'
        );

        return redirect()->route('all.plots')->with($notification);
    } //End method



    public function PlotsDelete($id)
    {
        Plot::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Project is deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function PlotEdit($id)
    {
        $plot = Plot::findOrFail($id); // Fetch the plot to be edited
        $projects = Project::all(); // Fetch all projects to populate the dropdown
        $categories = Category::all(); // Fetch all categories to populate the dropdown
        return view('backend.plots.editPlot', compact('plot', 'projects', 'categories'));
    }

    public function PlotUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'size' => ['required', 'numeric'],
            'project_id' => ['required', 'exists:projects,id'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $plot = Plot::findOrFail($id);
        $plot->name = $request->name;
        $plot->size = $request->size;
        $plot->project_id = $request->project_id;
        $plot->category_id = $request->category_id;

        $plot->save();

        $notification = array(
            'message' => 'Plot updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.plots')->with($notification);
    }

    public function PlotDetails($id)
    {
        // Fetch the first matching invoice_detail entry for the given plot_id
        $invoice_detail = InvoiceDetail::where('plot_id', $id)->first();

        // If no invoice detail is found, handle the error or return a 404 response
        if (!$invoice_detail) {
            return redirect()->back()->with('error', 'Invoice detail not found');
        }

        // Now use the invoice_id from the retrieved invoice_detail to fetch the invoice
        $invoice = Invoice::findOrFail($invoice_detail->invoice_id);

        // Return the view with the found invoice
        return view('backend.customer.editCustomerInvoice', compact('invoice'));
    }

    public function PlotDetailsTaken($id)
    {
        // Fetch the first matching invoice_detail entry for the given plot_id
        $invoice_detail = InvoiceDetail::where('plot_id', $id)->first();

        // If no invoice detail is found, handle the error or return a 404 response
        if (!$invoice_detail) {
            return redirect()->back()->with('error', 'Invoice detail not found');
        }

        // Now use the invoice_id from the retrieved invoice_detail to fetch the invoice
        $invoice = Invoice::findOrFail($invoice_detail->invoice_id);

        // Return the view with the found invoice
        return view('backend.customer.viewCustomerInvoice', compact('invoice'));
    }
}
