<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\AdminRoleController;
use App\Http\Controllers\admin\AdminPermissionController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//In the middleware(['auth','role:admin'])===here the role will come from the kernel that we set up before
//Modify this into ::Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin'])->middleware(['auth','role:admin'])->name('admin.index');
Route::middleware(['auth','role:admin'])->name('admin.')->// can be here :name('admin.')//('admin.index')
prefix('admin')->group(function(){// The prefix works for every route so be careful
    Route::delete('/roles/{role}/permissions/{permission}',[AdminRoleController::class,'destroyPermission'])->name('roles.permissions.revoke');
    Route::post('roles/{role}/permissions',[AdminRoleController::class,'givePermission'])->name('roles.addpermissions');
    Route::get('/',[HomeController::class,'admin'])->name('index');
    Route::get('/roles/create',[AdminRoleController::class,'create'])->name('roles.create');
    Route::get('/permissions/create',[AdminPermissionController::class,'create'])->name('permissions.create');
    //Route::post('/permissions/store',[AdminPermissionController::class,'store'])->name('permissions.store');
    Route::post('/roles/store',[AdminRoleController::class,'store'])->name('roles.store');
    Route::get('/roles',[AdminRoleController::class,'index'])->name('roles.index');
    Route::get('/roles/{role}/edit',[AdminRoleController::class,'edit'])->name('roles.edit');
    Route::get('/permissions/edit',[AdminPermissionController::class,'edit'])->name('permissions.edit');
   // Route::put('/permissions/update',[AdminPermissionController::class,'update'])->name('permissions.update');
    Route::put('/roles/{role}',[AdminRoleController::class,'update'])->name('roles.update');
    Route::delete('/roles/{role}',[AdminRoleController::class,'destroy'])->name('roles.destroy');
    //Route::delete('/permissions/{permission}',[AdminPermissionController::class,'destroy'])->name('permissions.destroy');
    Route::resource('/permissions',AdminPermissionController::class); //The project is designed to handle the resource for controlling index and
    //also can be used for more but here the route is designed in different way so that it throws error when i try to edit and making route as the
    //roles one
    //    Route::resource('/permissions',AdminPermissionController::class); //The project is designed to handle the resource for controlling index and
//The route is designed in such a way that it should have handled the CRUD functionalities easily but i don't know what i have done incorrectly
});
