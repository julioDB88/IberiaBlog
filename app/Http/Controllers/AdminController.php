<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        $cats= Category::all(); ;
        $last_posts= Post::orderBy('id','desc')->take(10)->get();
        $most_comented= Post::withCount('Comments')->get();

        return view('dashboard',compact('cats','last_posts','most_comented'));

    }

    public function editPage($page){

        return view("pages.".$page);
    }

    public function updatePage(Request $request,$page){

        if($page=='about'){
            DB::table('pages_content')->where('page',$page)->update(['content'=>$request->content]);
        }
        if($page=='contact'){
            DB::table('pages_content')->where('page',$page)->update(['content'=>$request->email]);
        }
        return redirect()->back()->with('success','Actualizado correctamente');
    }
}
