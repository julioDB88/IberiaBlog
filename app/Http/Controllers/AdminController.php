<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        $cats= Category::all(); ;
        $last_posts= Post::orderBy('id','desc')->take(10)->get();
        $most_commented= Post::withCount('Comments')->get();

        return view('dashboard',compact('cats','last_posts','most_commented'));

    }

    public function changeBgVideo(Request $request){
        $request->validate(['video'=>'file|mimes:mp4']);
        unlink(public_path('media/bg-video.mp4'));
        $request->file('video')->move(public_path('/media'),'bg-video.mp4');
        return redirect()->back()->with('success','Video updated');
    }
    public function changeLogo(Request $request){
        $request->validate(['logo'=>'image|mimes:png']);
        unlink(public_path('media/logo.png'));
        $request->file('logo')->move(public_path('/media'),'logo.png');
        return redirect()->back()->with('success','Logo updated');
    }

    public function editPage($page){
        $cats= Category::all();
        $social= DB::table('social_links')->get();

        return view("pages.".$page,compact('cats','social'));
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

    public function updateAuthor(Request $request){

        $request->validate([
            'subtitle'=>'required|string|max:25',
            'description'=>'required|string|max:121'
        ]);

        $user=User::find(Auth::user()->id);
        $user->update(['subtitle'=>$request->subtitle,'description'=>$request->description]);
        return redirect()->back()->with('success','Actualizado correctamente');


    }

    public function saveSocialUrl(Request $request){

        $request->validate([
            'twitter'=>'sometimes|nullable|url',
            'facebook'=>'sometimes|nullable|url',
            'instagram'=>'sometimes|nullable|url',
            'youtube'=>'sometimes|nullable|url',
        ]);

        if($request->twitter){
            DB::table('social_links')->where('name','twitter')->update(['url'=>$request->twitter]);
        }
        $request->twitter_c == 'on' ?
            DB::table('social_links')->where('name','twitter')->update(['active'=>1]):
            DB::table('social_links')->where('name','twitter')->update(['active'=>0]);

        if($request->facebook){
            DB::table('social_links')->where('name','facebook')->update(['url'=>$request->facebook]);
        }
        $request->facebook_c  == 'on' ?
            DB::table('social_links')->where('name','facebook')->update(['active'=>1]):
            DB::table('social_links')->where('name','facebook')->update(['active'=>0]);

        if($request->instagram){
            DB::table('social_links')->where('name','instagram')->update(['url'=>$request->instagram]);
        }
        $request->instagram_c  == 'on' ?
            DB::table('social_links')->where('name','instagram')->update(['active'=>1]):
            DB::table('social_links')->where('name','instagram')->update(['active'=>0]);

        if($request->youtube){
            DB::table('social_links')->where('name','youtube')->update(['url'=>$request->youtube]);
        }
        $request->youtube_c  == 'on' ?
            DB::table('social_links')->where('name','youtube')->update(['active'=>1]):DB::table('social_links')->where('name','youtube')->update(['active'=>0]);

        return redirect()->back()->with('success','updated succesfully');

    }

    public function activateSocialIcon(){

    }
}
