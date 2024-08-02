<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Notification;
use App\Models\Payment;
use App\Models\PaymentDetail;
use App\Models\Plot;
use App\Models\Product;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function allInvoices()
    {
        $invoices = Invoice::orderBy('date', 'desc')->orderBy('id', 'desc')->get();
        return view('backend.invoice.allInvoices', compact('invoices'));
    }

    public function addInvoice()
    {
        $invoice_data = Invoice::orderBy('id', 'desc')->first();
        $invoice_no = '0';
        if ($invoice_data == null) {
            $invoice_no += 1;
        } else {
            $invoice_no = $invoice_data->invoice_no + 1;
        }
        $projects = Project::all();
        $customers = Customer::all();
        // $categories = Category::all();

        $date = date("Y-m-d");
        return view('backend.invoice.addInvoice', compact('projects', 'customers', 'invoice_no', 'date'));
    }


    public function storeInvoice(Request $request)
    {
        // dd($request->all());
        if ($request->customer_id == 'select') {
            $notification = array(
                'message' => 'Sorry select Customer',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } else if ($request->project_id == null) {
            $notification = array(
                'message' => 'Sorry Plot Added',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } else if ($request->paid_status == null) {
            $notification = array(
                'message' => 'Sorry Paid status is Required',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } else if ($request->paid_amount > $request->estimated_amount) {
            $notification = array(
                'message' => 'Sorry Paid amount exceed Grand Total',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } else {
            // dd($request->all());

            $invoice = new Invoice();
            $invoice->invoice_no = $request->invoice_no;
            $invoice->date = date('Y-m-d', strtotime($request->date));
            $invoice->description = $request->description;
            $invoice->status = '0';
            $invoice->customer_id = $request->customer_id;
            $invoice->total_amount = $request->estimated_amount;
            // $invoice->region_id = Auth::user()->region_id;

            $invoice->created_by = Auth::user()->id;
            $invoice->created_at = Carbon::now();

            DB::transaction(function () use ($request, $invoice) {
                if (($invoice->save())) {
                    $count_plot = count($request->plot_id);
                    for ($i = 0; $i < $count_plot; $i++) {
                        $invoice_details = new InvoiceDetail();
                        $invoice_details->date = date('Y-m-d', strtotime($request->date));
                        $invoice_details->invoice_id = $invoice->id;
                        $invoice_details->category_id = $request->category_id[$i];
                        $invoice_details->project_id = $request->project_id[$i];
                        $invoice_details->size = $request->size[$i];
                        $invoice_details->price = $request->price[$i];
                        $invoice_details->plot_id = $request->plot_id[$i];
                        $invoice_details->status = '0';
                        $invoice_details->created_at = Carbon::now();
                        $invoice_details->created_by = Auth::user()->id;
                        $invoice_details->save();
                    }

                    $payment = new Payment();
                    $payment_details = new PaymentDetail();

                    $payment->invoice_id = $invoice->id;
                    $payment->customer_id = $request->customer_id;
                    // $payment->region_id = Auth::user()->region_id;
                    $payment->status = 0;
                    $payment->paid_status = $request->paid_status;
                    $payment->total_amount = $request->estimated_amount;
                    if ($request->discount_amount)
                        $payment->discount_amount = $request->discount_amount;
                    else
                        $payment->discount_amount = '0';

                    if ($request->paid_status == 'full_paid') {
                        $payment->paid_amount = $request->estimated_amount;
                        $payment->due_amount = '0';
                        $payment_details->current_paid_amount = $request->estimated_amount;
                    } else if ($request->paid_status == 'full_due') {
                        $payment->paid_amount = '0';
                        $payment->due_amount = $request->estimated_amount;
                        $payment_details->current_paid_amount = '0';
                    } else if ($request->paid_status == 'partial_paid') {
                        $payment->paid_amount = $request->paid_amount;
                        $payment->due_amount = $request->estimated_amount - $request->paid_amount;
                        $payment_details->current_paid_amount = $request->paid_amount;
                    }

                    $payment->save();

                    $payment_details->invoice_id = $invoice->id;
                    $payment_details->date = date('Y-m-d', strtotime($request->date));
                    $payment_details->created_at = Carbon::now();
                    $payment_details->save();
                }
            });
        }
        $notification = array(
            'message' => 'Invoice Data Inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.invoices')->with($notification);
    }
    public function pendingInvoices()
    {
        $invoices = Invoice::where('status', '0')->orderBy('date', 'desc')->orderBy('id', 'desc')->get();
        return view('backend.invoice.pendingInvoices', compact('invoices'));
    }
    public function approveInvoice($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('backend.invoice.approveInvoices', compact('invoice'));
    }
    public function viewInvoice($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('backend.invoice.viewInvoice', compact('invoice'));
    }

    public function dailyInvoiceReport()
    {
        return view('backend.invoice.dailyInvoiceReport');
    }

    public function getDailyInvoiceReport(Request $request)
    {
        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m-d', strtotime($request->end_date));
        $invoices = Invoice::where('status', 1)->whereBetween('date', [$start_date, $end_date])->get();
        return view('backend.invoice.getDailyInvoiceReport', compact('invoices', 'start_date', 'end_date'));
    }

    public function storeApproval($id)
    {
        // foreach ($request->selling_qty as $key => $val) {
        //     $invoice_details = InvoiceDetail::where('id', $key)->first();
        //     $product = Plot::where('id', $invoice_details->product_id)->first();

        //     if ($product->quantity < $val) {
        //         $notification = array(
        //             'message' => 'Sorry Stock Quantity is Insufficient',
        //             'alert-type' => 'error'
        //         );
        //         return redirect()->back()->with($notification);
        //     }
        // }

        $invoice = Invoice::findOrFail($id);
        $invoice->updated_by = Auth::user()->id;
        $invoice->status = '1';

        DB::transaction(function () use ($invoice) {
            foreach ($invoice->invoiceDetail as  $detail) {
                $invoice_details = InvoiceDetail::where('id', $detail->id)->first();
                $invoice_details->status = '1';
                $invoice_details->save();
                $payment = Payment::where('invoice_id', $invoice->id)->first();
                $product = Plot::where('id', $invoice_details->plot_id)->first();
                // $nono = (float)($product->quantity) - (float)($val);
                if ($payment->paid_status == 'full_paid') {
                    $product->status = 2;
                } else {
                    $product->status = 1;
                }
                $product->save();
                // if ($nono <= 200)
                //     Notification::insert([
                //         'product_id' => $invoice_details->product_id,
                //         'description' => 'stock is running out',
                //         'amount' => $nono,
                //         'status' => 0,
                //         'created_at' => Carbon::now(),
                //     ]);
            }
            $invoice->save();
        });

        $payment = Payment::where('invoice_id', $id)->first();
        $payment->status = '1';
        $payment->save();


        $notification = array(
            'message' => 'Invoice Approved Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('pending.invoices')->with($notification);
    }

    public function deleteInvoice($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        InvoiceDetail::where('invoice_id', $invoice->id)->delete();
        Payment::where('invoice_id', $invoice->id)->delete();
        PaymentDetail::where('invoice_id', $invoice->id)->delete();

        $notification = array(
            'message' => 'Invoice Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    public function getCategory(Request $request)
    {
        $categories = Category::where('project_id', $request->project_id)->get();
        return response()->json($categories);
    }

    public function getPlot(Request $request)
    {
        $plots = Plot::where('category_id', $request->category_id)->get();
        foreach ($plots as $plot) {
            $plot->price = $plot->category->price  * $plot->size;
        }
        return response()->json($plots);
    }
    public function getProduct(Request $request)
    {

        $products = Plot::where('category_id', $request->category_id)->get();
        return response()->json($products);
    }
    public function getStock(Request $request)
    {

        $stock = Plot::select('quantity')->where('region_id', Auth::user()->region_id)->where('id', $request->product_id)->get();
        // dd($stock);
        return response()->json($stock);
    }
}
