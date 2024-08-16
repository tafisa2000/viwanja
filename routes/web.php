<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\pos\CategoryController;
use App\Http\Controllers\Pos\CustomerController;
use App\Http\Controllers\pos\ProjectController;
use App\Http\Controllers\pos\PlotsController;
use App\Http\Controllers\pos\ExpenseCategoryController;
use App\Http\Controllers\pos\ExpenseController;
use App\Http\Controllers\Pos\InvoiceController;
use App\Models\Notification;
use Symfony\Component\HttpKernel\Profiler\Profile;

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

Route::get('/change', [ProfileController::class, 'changeLang'])->name('change');

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
        Route::get('/all/role', 'AllRole')->name('all.role');
        Route::get('/add/user', 'AddUser')->name('add.user');
        Route::get('/add/role', 'AddRole')->name('role.add');
        Route::get('/user/delete/{id}', 'DeleteUser')->name('user.delete');
        Route::get('/user/edit/{id}', 'UserEdit')->name('user.edit');
        Route::post('/store/user', 'StoreUser')->name('user.store');
        Route::post('/store/role', 'StoreRole')->name('role.store');
        Route::put('/user/update/{id}', 'UpdateUser')->name('user.update');
    });
    // Category All Route
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/all/category', 'AllCategory')->name('all.category');
        Route::get('/add/category', 'AddCategory')->name('category.add');
        Route::get('/edit/projectCategories/{id}', 'ProjectCategoriesEdit')->name('projectCategories.edit');
        Route::post('/projectCategory/store', 'StoreProjectCategory')->name('projectCategory.store');
        Route::put('/project-category/update/{id}', 'ProjectCategoriesUpdate')->name('projectCategory.update');
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

    // Nofication All Route
    Route::controller(NotificationController::class)->group(function () {
        Route::get('/all/notification', 'index')->name('all.notification');
        Route::get('/add/notification', 'create')->name('notification.add');
        Route::post('/notification/store', 'store')->name('notification.store');
        Route::get('/notification/edit/{id}', 'edit')->name('notification.edit');
        Route::get('/notification/delete/{id}', 'delete')->name('notification.delete');
        Route::post('/update/notification', 'update')->name('notification.update');
    });
    // Plots All Route
    Route::controller(PlotsController::class)->group(function () {
        Route::get('/all/plots', 'AllPlots')->name('all.plots');
        Route::get('/add/plot', 'PlotAdd')->name('plot.add');
        Route::post('/plot/store', 'PlotStore')->name('plot.store');
        Route::get('/plot/location', 'plotLocation')->name('plots.locations');
        Route::get('/plots/delete/{id}', 'PlotsDelete')->name('plots.delete');
        Route::get('/plots/detail/{id}', 'PlotDetails')->name('plots.detail');
        Route::get('/plots/detail/taken/{id}', 'PlotDetailsTaken')->name('plots.detail.taken');
        Route::get('/plot/edit/{id}', 'PlotEdit')->name('plot.edit');
        Route::put('/plot/update/{id}', 'PlotUpdate')->name('plot.update');
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

    Route::controller(CustomerController::class)->group(function () {
        Route::get('/admin/all/customers', 'allCustomers')->name('all.customers');
        Route::get('/admin/add/customer', 'addCustomer')->name('add.customer');
        Route::post('/admin/store/customer', 'storeCustomer')->name('store.customer');
        Route::get('/admin/edit/customer/{id}', 'editCustomer')->name('edit.customer');
        Route::post('/admin/update/customer', 'updateCustomer')->name('update.customer');
        Route::get('/admin/delete/customer/{id}', 'deleteCustomer')->name('delete.customer');
        Route::get('/admin/credit/customer', 'creditCustomers')->name('credit.customers');
        Route::get('/admin/customers/purchases', 'customersPurchases')->name('customers.purchases');
        Route::get('/admin/print/customers/purchases', 'printCustomersPurchases')->name('print.customers.purchases');
        Route::get('/admin/customer/purchases/{id}', 'customerPurchases')->name('customer.purchases');
        Route::get('/admin/print/credit/customer', 'printCreditCustomers')->name('print.credit.customers');
        Route::get('/admin/edit/customer/invoice/{id}', 'editCustomerInvoice')->name('edit.customer.invoice');
        Route::post('/admin/update/customer/invoice/{invoice_id}', 'updateCustomerInvoice')->name('update.customer.invoice');
        Route::get('/admin/view/customer/invoice/{invoice_id}', 'viewCustomerInvoice')->name('view.customer.invoice');
    });

    Route::controller(InvoiceController::class)->group(function () {
        Route::get('/admin/all/invoices', 'allInvoices')->name('all.invoices');
        Route::get('/admin/all/payments', 'allPayment')->name('all.payments');
        Route::get('/admin/pending/invoices', 'pendingInvoices')->name('pending.invoices');
        Route::get('/admin/approve/invoice/{id}', 'approveInvoice')->name('approve.invoice');
        Route::get('/admin/add/invoices', 'addInvoice')->name('add.invoice');
        Route::post('/admin/store/invoice', 'storeInvoice')->name('store.invoice');
        Route::get('/admin/delete/invoice/{id}', 'deleteInvoice')->name('delete.invoice');
        Route::get('/admin/store/approval/{id}', 'storeApproval')->name('store.approval');
        Route::get('/admin/view/invoice/{id}', 'viewInvoice')->name('view.invoice');
        Route::get('/admin/get-stock', 'getStock')->name('get-stock');
        Route::get('/admin/get-product-invoice', 'getProduct')->name('get-product-invoice');
        Route::get('/admin/get-category-invoice', 'getCategory')->name('get-category-invoice');
        Route::get('/admin/get-plot-invoice', 'getPlot')->name('get-plot-invoice');
        Route::get('/admin/daily/invoice/report', 'dailyInvoiceReport')->name('daily.invoice.report');
        Route::get('/admin/get/daily/invoice/report', 'getDailyInvoiceReport')->name('get.daily.invoice.report');
    });

    Route::controller(ExpenseController::class)->group(function () {
        Route::get('/expense/add', 'ExpenseAdd')->name('expense.add');
        Route::post('/expense/store', 'ExpenseStore')->name('expense.store');
        // Route::post('/expense/edit', 'ExpenseUpdate')->name('expense.edit');
        Route::get('/today/expense', 'TodayExpense')->name('today.expense');
        Route::get('/expense/edit/{id}', 'ExpenseEdit')->name('expense.edit');
        Route::get('/delete/expense/{id}', 'DeleteExpense')->name('Expense.delete');
        Route::get('/expense/category/{id}', 'showCategoryExpense')->name('category.expense');
        // Route::get('/monthly/expense', 'MonthlyExpense')->name('monthly.expense');
        // Route::get('/yearly/expense', 'YearlyExpense')->name('yearly.expense');
        Route::get('/wisely/expense', 'DailyExpense')->name('wisely.expense');
        Route::post('/daily/expense/pdf', 'DailyExpensePdf')->name('daily.expense.pdf');
        Route::put('/expense/update/{id}', 'ExpenseUpdate')->name('expense.update');
    });



    // // Add dynamic routes for categories if required
    // foreach (App\Models\ExpenseCategory::all() as $category) {
    //     Route::get('/expense/' . $category->name, [ExpenseController::class, 'showCategoryExpense'])->name($category->name . '.expense');
    // }
});

require __DIR__ . '/auth.php';
