<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
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

//Common resource routes :
//index - show all listings
//show - show single listing
//create - chos w form to create new listing
//store -  store new listing
//edit - show form to edit listing
//update -update listing
//destroy - delete listing

// Getting All Listings

Route::get('/', [ListingController::class, 'index']);

// show create form

Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// store Listing data

Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

// show edit form

Route::get('/listings/{listing}/edit', 
[ListingController::class, 'edit'])->middleware('auth');

//update listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

//delete listings
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

// Manage Listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

//show register create form

Route::get('/register', [UserController::class, 'create'])->middleware('guest');

//create new user

Route::post('/users', [UserController::class, 'store']);

// Log User Out

Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show Login Form

Route::get('/login', [UserController::class, 'login'])->name(
    'login'
)->middleware('guest');

//manage listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

//Log in User

Route::post('/users/authenticate', [UserController::class, 'authenticate']);

// Single Listing

Route::get('/listings/{listing}', [ListingController::class, 'show']);



/* fun stuff below
//creating error page
Route::get('/error', function () {
    return response('<h1>Sorry there was an issue </h1>', 404)
    ->header('Content-Type', 'text/plain')
    ->header('foo'  , 'bar');
});
// And a Hello page for fun
Route::get('/hello', function(){
    return response('<h1> Hello World</h1>', 200)
    ->header('Content-Type', 'text/plain')
    ->header('foo','bar');
});


Route::get('/posts/{id}', function($id){

    return response('Post'. $id);
})->where('id','[0-9]+');


Route::get('/search', function(Request $request){
   
   return $request->name . ' ' . $request->city; 

});*/


