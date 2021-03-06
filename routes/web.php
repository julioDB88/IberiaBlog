<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SettingsController;
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

    Route::get('/',[HomeController::class,'index'])->name('home');
    Route::get('/news/search',[HomeController::class,'searchPosts'])->name('search.posts');
    Route::get('news/category/{slug}',[HomeController::class,'showCategoryNews'])->name('news.category');
    Route::get('news/{slug}',[HomeController::class,'showNews'])->name('news.show');
    Route::get('legal/{page}',[HomeController::class,'showLegal'])->name('legal.show');
    Route::get('contact',function(){
        return view('guest.contact');
    })->name('contact');
    Route::post('contact',[HomeController::class,'contactMe'])->name('contact.post');

    //coment store
    Route::post('comments',[HomeController::class,'storeComment'])->name('comment.store');


    //invitations
    Route::get('invitation/{invitation}',[InvitationController::class,'accept'])->name('invitation.accept');

    Route::get('{page}',[HomeController::class,'showPage'])->name('page.show')->middleware('activePage');


});

Route::prefix('admin')->middleware(['auth:sanctum', 'verified','isMember'])->group(function () {
   Route::get('/dashboard',[AdminController::class,'index'])->name('dashboard');
   Route::put('/social/{social}',[AdminController::class,'updateSocialLink'])->name('social.update')->middleware('isAdmin');;
   Route::post('/social',[AdminController::class,'storeSocialLink'])->name('social.store')->middleware('isAdmin');;
   Route::delete('/social/{social}',[AdminController::class,'destroySocialLink'])->name('social.destroy')->middleware('isAdmin');;
   Route::resource('categories',CategoryController::class);
   Route::resource('posts',PostController::class);




    Route::get('pages/{page}',[AdminController::class,'editPage'])->name('pages.edit');
    Route::put('pages/{page}',[AdminController::class,'updatePage'])->name('pages.update');
    Route::put('author',[AdminController::class,'updateAuthor'])->name('author.update');

    // coments
    Route::put('comments/{comment}',[AdminController::class,'acceptComment'])->name('comment.accept');
    Route::delete('comments/{comment}',[AdminController::class,'deleteComment'])->name('comment.delete');

     // invitations
     Route::get('invitations/list',[InvitationController::class,'show'])->name('invitations.list');
     Route::post('invitation',[InvitationController::class,'store'])->name('invitation.store');
     Route::delete('invitations/{invitation}',[InvitationController::class,'destroy'])->name('invitation.destroy');

    //settings
    Route::get('settings',[SettingsController::class,'index'])->name('settings');
    Route::put('settings/video',[SettingsController::class,'changeBgVideo'])->name('changeVideo')->middleware('isAdmin');
    Route::put('settings/logo',[SettingsController::class,'changeLogo'])->name('changeLogo')->middleware('isAdmin');




});
