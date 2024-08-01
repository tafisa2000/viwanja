<?php

namespace App\Http\Controllers\pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;


class ExpenseController extends Controller
{
    //
    public function ExpenseAdd()
    {
        $date = date('Y-m-d');
        $category = ExpenseCategory::all();

        return view('backend.expenses.expense_add', compact('date', 'category'));
    }


    public function ExpenseStore(Request $request)
    {
        Expense::insert([
            'details' => $request->details,
            'amount' => $request->amount,
            'month' => $request->month,
            'year' => $request->year,
            'date' => $request->date,
            'category_id' => $request->category_id,
            'created_at' => Carbon::now(),
        ]);


        $notification = array(
            'message' => 'Expense Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('today.expense')->with($notification);
    }


    public function TodayExpense()
    {
        $category
            = ExpenseCategory::all();
        $date = date('Y-m-d');
        $allExpenses = Expense::latest()->get(); // Fetch today's expenses
        $totalExpense = $allExpenses->sum('amount'); // Calculate the sum of the amounts
        return view('backend.expenses.today_expense', compact('totalExpense', 'allExpenses', 'category'));
    }
    public function DeleteExpense($id)
    {
        Expense::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Project is deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function showCategoryExpense($id)
    {
        $category = ExpenseCategory::all();
        $expenseCategory = ExpenseCategory::findOrFail($id);
        $expense = Expense::where('category_id', $id)->latest()->get();
        return view('backend.expenses.category_expense', compact('expense', 'category', 'expenseCategory'));
    }
    public function DailyExpense()
    {
        $category = ExpenseCategory::all();

        return view('backend.expenses.daily_expenses', compact('category'));
    } // End Method
    public function DailyExpensePdf(Request $request)
    {
        $category = ExpenseCategory::all();
        $sdate = date('Y-m-d', strtotime($request->start_date));
        $edate = date('Y-m-d', strtotime($request->end_date));

        if ($request->category_id == 999) {
            // Fetch expenses for all categories between the selected dates
            $allData = Expense::whereBetween('date', [$sdate, $edate])->get();
        } else {
            // Fetch expenses for the selected category between the selected dates
            $allData = Expense::where('category_id', $request->category_id)
                ->whereBetween('date', [$sdate, $edate])
                ->get();
        }

        // Passing start_date and end_date in 'd-m-Y' format to the view
        $start_date = date('d-m-Y', strtotime($request->start_date));
        $end_date = date('d-m-Y', strtotime($request->end_date));

        return view('backend.expenses.daily_expense_report_pdf', compact('allData', 'start_date', 'end_date'));
    }
}
