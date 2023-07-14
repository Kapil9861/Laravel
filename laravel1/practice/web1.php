<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/hello', function () {
    return response('<h1>Hyalu<h1/>',200)
    //response type sets the response to be treated as the html code
    //second parameter is the http status 200 OK(in this case)
    ->header('Content-Type', 'text/pain')
    //This will set the content type to text/plain so that the h1 tag above won't work
    ->header('foo','bar');
    //Setting the for bar type
});

//wild cards or route parameters
Route::get('/{id}',function($id){
    //Die and Dump
    //dd($id);
    //Dump Die and debug
    ddd($id); //Not sure if it exists as is not in documentation
    return response('The id is '.$id);
})->where('id','[0-9]+');// the where here returns the id with requirements here it is
//this can be of integers from 0-9 +++===the + signs represents that multiple digit numbers

//Query Parameters
Route::get('/search',function(Request $request){
    //dd($request); //for details
    return($request->name.''.$request->age);
});