<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\pos\CategoryController;
use App\Http\Controllers\pos\ProjectController;
use App\Http\Controllers\pos\PlotsController;
use App\Http\Controllers\pos\ExpenseCategoryController;
use App\Http\Controllers\pos\ExpenseController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    // Admin All Route
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/logout', 'destroy')->name('admin.logout');
        Route::get('/admin/profile', 'profile')->name('admin.profile');
        Route::get('/edit/profile', 'Editprofile')->name('edit.profile');
        Route::post('/store/profile', 'storeprofile')->name('store.profile');
        Route::get('/change/password', 'changepassword')->name('change.password');
        Route::post('/update/password', 'updatepassword')->name('update.password');
        Route::get('/all/user', 'AllUser')->name('all.user');
        Route::get('/add/user', 'AddUser')->name('user.add');
    });
    // Category All Route
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/all/category', 'AllCategory')->name('all.category');
        Route::get('/add/category', 'AddCategory')->name('category.add');
        Route::get('/edit/projectCategories/{id}', 'ProjectCategoriesEdit')->name('projectCategories.edit');
        Route::post('/projectCategory/store', 'StoreProjectCategory')->name('projectCategory.store');
        Route::get('/category/delete/{id}', 'DeleteCategory')->name('category.delete');
    });

    // Category All Route
    Route::controller(ProjectController::class)->group(function () {
        Route::get('/all/project', 'AllProject')->name('all.project');
        Route::get('/add/project', 'ProjectAdd')->name('project.add');
        Route::post('/project/store', 'ProjectStore')->name('project.store');
        Route::get('/project/edit/{id}', 'ProjectEdit')->name('project.edit');
        Route::get('/project/delete/{id}', 'ProjectDelete')->name('project.delete');
        Route::post('/update/project', 'UpdateProject')->name('project.update');
    });
    // Plots All Route
    Route::controller(PlotsController::class)->group(function () {
        Route::get('/all/plots', 'AllPlots')->name('all.plots');
        Route::get('/add/plot', 'PlotAdd')->name('plot.add');
        Route::post('/plot/store', 'PlotStore')->name('plot.store');
        // Route::get('/project/edit/{id}', 'ProjectEdit')->name('project.edit');
        Route::get('/plots/delete/{id}', 'PlotsDelete')->name('plots.delete');
        // Route::post('/update/project', 'UpdateProject')->name('project.update');
    });
    // Plots All Route
    Route::controller(ExpenseCategoryController::class)->group(function () {
        Route::get('/categoryExpense/all', 'CategoryAll')->name('categoryExpense.all');
        Route::get('/categoryExpense/add', 'CategoryAdd')->name('categoryExpense.add');
        Route::post('/categoryExpense/store', 'CategoryStore')->name('categoryExpense.store');
        Route::get('/categoryExpense/edit/{id}', 'CategoryEdit')->name('categoryExpense.edit');
        Route::post('/categoryExpense/update', 'CategoryUpdate')->name('categoryExpense.update');
        Route::get('/categoryExpense/delete/{id}', 'CategoryDelete')->name('categoryExpense.delete');
    });

    Route::controller(ExpenseController::class)->group(function () {
        Route::get('/expense/add', 'ExpenseAdd')->name('expense.add');
        Route::post('/expense/store', 'ExpenseStore')->name('expense.store');
        // Route::post('/expense/edit', 'ExpenseUpdate')->name('expense.edit');
        Route::get('/today/expense', 'TodayExpense')->name('today.expense');
        // Route::get('/edit/expense/{id}', 'EditExpense')->name('edit.expense');
        Route::get('/edit/expense/{id}', 'DeleteExpense')->name('Expense.delete');
        Route::get('/expense/category/{id}', 'showCategoryExpense')->name('category.expense');
        // Route::get('/monthly/expense', 'MonthlyExpense')->name('monthly.expense');
        // Route::get('/yearly/expense', 'YearlyExpense')->name('yearly.expense');
        Route::get('/wisely/expense', 'DailyExpense')->name('wisely.expense');
        Route::post('/daily/expense/pdf', 'DailyExpensePdf')->name('daily.expense.pdf');
    });



    // // Add dynamic routes for categories if required
    // foreach (App\Models\ExpenseCategory::all() as $category) {
    //     Route::get('/expense/' . $category->name, [ExpenseController::class, 'showCategoryExpense'])->name($category->name . '.expense');
    // }
});

require __DIR__ . '/auth.php';
