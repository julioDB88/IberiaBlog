<?php

use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::put('/comment/switch-visible',[CommentController::class,'switchVisible']);
// Route::middleware('auth:sanctum')->group( function () {
//     Route::get('/videos-active/{bool}',function(Request $request,$bool){
//         if($bool){
//

//         }else{
//             DB::table('page_content')->where('name','videos')->update(['content','null']);

//         }
//     });
// });
