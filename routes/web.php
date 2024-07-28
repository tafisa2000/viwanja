<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\pos\CategoryController;
use App\Http\Controllers\pos\ProjectController;
use App\Http\Controllers\pos\PlotsController;


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
});

require __DIR__ . '/auth.php';
