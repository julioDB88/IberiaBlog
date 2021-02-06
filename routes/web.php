<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
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
Route::get('/logout','Laravel\Fortify\Http\Controllers\AuthenticatedSessionController@destroy');

Route::middleware(['web'])->group(function(){

    Route::get('/',[HomeController::class,'index'])->name('home');
    Route::get('news/category/{slug}',[HomeController::class,'showCategoryNews'])->name('news.category');
    Route::get('news/{slug}',[HomeController::class,'showNews'])->name('news.show');
    Route::get('{page}',[HomeController::class,'showPage'])->name('page.show');
    Route::post('contact',[HomeController::class,'contactMe'])->name('contact');


});

Route::prefix('admin')->middleware(['auth:sanctum', 'verified','isMember'])->group(function () {
   Route::get('/dashboard',[AdminController::class,'index'])->name('dashboard');
   Route::get('/social',[AdminController::class,'saveSocialUrl'])->name('rrss.update');
   Route::resource('categories',CategoryController::class);
   Route::resource('posts',PostController::class);
   Route::get('pages/{page}',[AdminController::class,'editPage'])->name('pages.edit');
   Route::put('pages/{page}',[AdminController::class,'updatePage'])->name('pages.update');
});
