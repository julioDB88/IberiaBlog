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
        $most_commented= Post::withCount('Comments')->get();

        return view('dashboard',compact('cats','last_posts','most_commented'));

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

    public function saveSocialUrl(Request $request){

        $request->validate([
            'twitter'=>'sometimes|url',
            'facebook'=>'sometimes|url',
            'instagram'=>'sometimes|url',
            'youtube'=>'sometimes|url',
        ]);

        if($request->twitter){
            DB::table('social_links')->where('name','twitter')->update(['url'=>$request->twitter]);
        }
        $request->twitter_c?
            DB::table('social_links')->where('name','twitter')->update(['active'=>1]):
            DB::table('social_links')->where('name','twitter')->update(['active'=>0]);

        if($request->facebook){
            DB::table('social_links')->where('name','facebook')->update(['url'=>$request->facebook]);
        }
        $request->facebook_c ?
            DB::table('social_links')->where('name','facebook')->update(['active'=>1]):
            DB::table('social_links')->where('name','facebook')->update(['active'=>0]);

        if($request->instagram){
            DB::table('social_links')->where('name','instagram')->update(['url'=>$request->instagram]);
        }
        $request->instagram_c ?
            DB::table('social_links')->where('name','instagram')->update(['active'=>1]):
            DB::table('social_links')->where('name','instagram')->update(['active'=>0]);

        if($request->youtube){
            DB::table('social_links')->where('name','youtube')->update(['url'=>$request->youtube]);
        }
        $request->youtube_c ?
            DB::table('social_links')->where('name','youtube')->update(['active'=>1]):DB::table('social_links')->where('name','youtube')->update(['active'=>0]);

        return redirect()->back()->with('success','updated succesfully');

    }

    public function activateSocialIcon(){

    }
}
