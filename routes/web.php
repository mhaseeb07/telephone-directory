<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PermissionGroupController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ReminderController;
use App\Http\Controllers\Admin\ContactInformationController;
use App\Http\Controllers\front\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class,'index'])->name('main');
Route::group(['middleware' => ['auth','verified','IsActive','xss'],'prefix'=>'admin'], function() {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::resource('permission_group',PermissionGroupController::class);
    Route::resource('permission',PermissionController::class);
    Route::resource('role',RoleController::class);
    Route::get('get/roles',[RoleController::class,'getRoles'])->name('getRoles');
    Route::resource('user',UserController::class);
    Route::get('get/users',[UserController::class,'getUsers'])->name('getUsers');

    // Department 
    Route::resource('department', DepartmentController::class);
    Route::get('get/department',[DepartmentController::class,'getDepartment'])->name('getDepartment');
    Route::delete('department-delete/{id}', [DepartmentController::class,'delete'])->name('department.delete');
    Route::get('department-restore/{id}', [DepartmentController::class,'restore'])->name('department.restore');

    // Category 
    Route::resource('category', CategoryController::class);
    Route::get('get/category',[CategoryController::class,'getCategory'])->name('getCategory');
    Route::delete('category-delete/{id}', [CategoryController::class,'delete'])->name('category.delete');
    Route::get('category-restore/{id}', [CategoryController::class,'restore'])->name('category.restore');

    // Reminder 
    Route::resource('contact-info', ContactInformationController::class);
    Route::get('get/getContactInfo',[ContactInformationController::class,'getContactInfo'])->name('getContactInfo');
    Route::delete('contact-info-delete/{id}', [ContactInformationController::class,'delete'])->name('contact-info.delete');
    Route::get('contact-info-restore/{id}', [ContactInformationController::class,'restore'])->name('contact-info.restore');

     // Reminder 
     Route::resource('reminder', ReminderController::class);
    //  Route::get('get/category',[CategoryController::class,'getCategory'])->name('getCategory');
    //  Route::delete('category-delete/{id}', [CategoryController::class,'delete'])->name('category.delete');
    //  Route::get('category-restore/{id}', [CategoryController::class,'restore'])->name('category.restore');
});
Route::get('/logout', function () {
    Auth::logout();
    return redirect(route('login'));
});
Auth::routes();

