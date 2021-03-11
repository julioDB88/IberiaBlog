<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){

        return view('dashboard');

    }


    public function editPage($page){
        $cats= Category::all();

        $coms='';
        if($page=='comments'){
          $coms=  Comment::where('visible',0)->paginate(15);
        }

        return view("pages.".$page,compact('cats','coms'));
    }

    public function updatePage(Request $request,$page){

        if($page=='about'){
            DB::table('pages_content')->where('name',$page)->update(['content'=>$request->content]);
        }
        if($page=='contact'){
            DB::table('pages_content')->where('name',$page)->update(['content'=>$request->email]);
        }

        return redirect()->back()->with('success','Actualizado correctamente');
    }

    public function updateAuthor(Request $request){

        $request->validate([
            'subtitle'=>'required|string|max:25',
            'description'=>'required|string|max:121'
        ]);

        $user=User::find(Auth::user()->id);
        $user->update(['subtitle'=>$request->subtitle,'description'=>$request->description]);
        return redirect()->back()->with('success','Actualizado correctamente');


    }
    public function acceptComment(Request $request,Comment $comment){

        $comment->update(['visible'=>1]);
        return redirect()->back()->with('success','Actualizado correctamente');

    }

    public function deleteComment(Comment $comment){
        $comment->delete();
        return redirect()->back()->with('success','Actualizado correctamente');
    }



}
