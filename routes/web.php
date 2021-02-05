<?php

use App\Http\Controllers\PostController;
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

Route::middleware(['web'])->group(function(){
    Route::get('/', function () {return view('guest.home');})->name('home');
});

Route::prefix('admin')->middleware(['auth:sanctum', 'verified','isMember'])->group(function () {
   Route::get('/',function(){ return view('dashboard');})->name('dashboard');
   Route::resource('posts',PostController::class);
   Route::get('autors',function(){ return view('dashboard');})->name('autors');
});
