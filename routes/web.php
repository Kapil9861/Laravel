<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\Admin\RoleController;

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

//All listings 
Route::get('/',[\App\Http\Controllers\ListingController::class,'index']);

//Show create job listing form and must be above the listing as the create is also treated as 
// the listing also generally done mistake is function name always gets outsid the []
Route::get('/listing/create',[\App\Http\Controllers\ListingController::class,'create'])->middleware('auth');

Route::POST('/listing',[\App\Http\Controllers\ListingController::class,'store'])->middleware('auth');

//update
Route::put('/show/{listing}',[\App\Http\Controllers\ListingController::class,'update'])->middleware('auth');

//DELETE THE LISTING
Route::delete('/show/{listing}',[\App\Http\Controllers\ListingController::class,'destroy'])->middleware('auth');

//show edit form Most got problem is with the []
Route::get('/show/{listing}/edit',[\App\Http\Controllers\ListingController::class,'edit'])->middleware('auth');


// WE ALSO HAVE OPTION TO WORK WITH THE ELEQUENT MODEL
// This will aso have the 404 error in itself so no need to worry 
//with that too
Route::get('/show/{listing}',[\App\Http\Controllers\ListingController::class,'show']);

//Registration and login for user
//Show registration form
Route::get('/register',[\App\Http\Controllers\UserController::class,'create'])->middleware('guest');// can be register but following naming convention

//Create new users
Route::post('/users',[UserController::class,'store']);

//Show login form the name is provided such that the  middleware understands which name to follow
//as the route understand the path inside the name
Route::get('/login',[UserController::class,'login'])->middleware('guest')->name('login');

//Login User
Route::post('/users/authenticate',[UserController::class,'authenticate']);

//Manage Listing
Route::get('/listing/manage',[ListingController::class,'manage'])->middleware('auth');

//logout for user
Route::post('/logout',[UserController::class,'logout'])->middleware('auth');

//Permissions
// Route::get('/all/permission',[RoleController::class,'AllPermission'])->name('all.permission');
//name-> must be defined in the to call it in the route('')