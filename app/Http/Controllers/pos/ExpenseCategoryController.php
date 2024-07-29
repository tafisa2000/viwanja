<?php

namespace App\Http\Controllers\pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class ExpenseCategoryController extends Controller
{
    //
    public function CategoryAll()
    {
        $category = ExpenseCategory::latest()->get();
        return view('backend.expense_category.category_all', compact('category'));
        // return response()->json(['cate' => $category]);
    }
    public function CategoryAllApi()
    {
        $category = ExpenseCategory::latest()->get();
        // return view('backend.category.category_all', compact('category'));
        return response()->json(['cate' => $category]);
    }

    public function CategoryAdd()
    {
        return view('backend.expense_category.category_add');
    }

    public function CategoryStore(Request $request)
    {

        // $category = new ExpenseCategory();
        // $category->name = $request->name;
        // $category->created_by = Auth::user()->id;
        // $category->save();

        // alternative solutions

        ExpenseCategory::insert([
            'name' => $request->name,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Category is inserted successfuly',
            'alert-type' => 'success'
        );

        return redirect()->route('categoryExpense.all')->with($notification);
    }

    public function CategoryStoreApi(Request $request)
    {
        $category = new ExpenseCategory();
        $category->name = $request->name;
        $category->created_by = 1;
        $category->save();

        // alternative solutions

        //  Category::insert([
        //         'name' => $request->name,     
        //         'created_by' => Auth::user()->id,   
        //         'created_at' => Carbon::now(),   
        //         'updated_at' => Carbon::now(),   

        // ]);

        $notification = array(
            'message' => 'Category is inserted successfuly',
            'alert-type' => 'success'
        );

        // return redirect()->route('category.all')->with($notification);
        return response()->json(['message' => 'Category Created succesfuly']);
    }

    public function CategoryEdit($id)
    {
        $category = ExpenseCategory::findOrFail($id);

        return view('backend.expense_category.category_edit', compact('category'));
    }

    public function CategoryUpdate(Request $request)
    {
        $category = ExpenseCategory::findOrFail($request->id);
        $category->name = $request->name;
        $category->updated_by = Auth::user()->id;
        $category->save();
        // $category_id = $request->id;
        // Category::findOrfail($category_id)->update([
        //         'name' => $request->name,
        //         'updated_by' => Auth::user()->id,   
        //         'updated_at' => Carbon::now(),   

        // ]);

        $notification = array(
            'message' => 'Category is updated successfuly',
            'alert-type' => 'success'
        );

        return redirect()->route('category.all')->with($notification);
    }


    public function CategoryDelete($id)
    {

        ExpenseCategory::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Category is deleted successfuly',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
    public function CategoryDeleteApi($id)
    {

        ExpenseCategory::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Category is deleted successfuly',
            'alert-type' => 'success'
        );

        return response()->json(['message' => 'Category Created succesfuly']);
    }
}
