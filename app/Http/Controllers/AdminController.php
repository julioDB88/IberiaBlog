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
        $cats= Category::all(); ;
        $last_posts= Post::orderBy('id','desc')->take(10)->get();
        $most_commented= Post::withCount('Comments')->orderBy('comments_count','desc')->take(10)->get();
        return view('dashboard',compact('cats','last_posts','most_commented'));

    }

    public function changeBgVideo(Request $request){
        $request->validate(['video'=>'file|mimes:mp4|required']);
        unlink(public_path('media/bg-video.mp4'));
        $request->file('video')->move(public_path('/media'),'bg-video.mp4');
        return redirect()->back()->with('success','Video updated');
    }
    public function changeLogo(Request $request){
        $request->validate(['logo'=>'image|mimes:png|required|max:2048']);
        unlink(public_path('media/logo.png'));
        $request->file('logo')->move(public_path('/media'),'logo.png');
        return redirect()->back()->with('success','Logo updated');
    }

    public function editPage($page){
        $cats= Category::all();
        $social= DB::table('social_links')->get();
        $coms='';
        if($page=='comments'){
          $coms=  Comment::where('visible',0)->paginate(15);
        }

        return view("pages.".$page,compact('cats','social','coms'));
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
    public function acceptComment(Request $request,Comment $comment){

        $comment->update(['visible'=>1]);
        return redirect()->back()->with('success','Actualizado correctamente');

    }

    public function deleteComment(Comment $comment){
        $comment->delete();
        return redirect()->back()->with('success','Actualizado correctamente');
    }

    public function updateSocialLink(Request $request,$id){

        $request->validate([
            'name'=>'required|string|max:15',
            'url'=>'required|url',
        ]);

        $active = $request->active ? 1:0;

        DB::table('social_links')->where('id',$id)->update([
            'name'=>$request->name,
            'url'=>$request->url,
            'active'=>$active,
        ]);




        return redirect()->back()->with('success','updated_succesfully');

    }
    public function storeSocialLink(Request $request){
        $request->validate([
            'name'=>'required|string|max:15',
            'url'=>'required|string',
            'icon'=>'required|image|mimes:png,jpg,svg|max:2048'
        ]);

        $filename = time() . "." . $request->file('icon')->getClientOriginalExtension();
        $request->file('icon')->storeAs("public/logos", $filename);

        DB::table('social_links')->insert([
            'name'=>$request->name,
            'url'=>$request->url,
            'icon'=>$filename,
        ]);
        return redirect()->back()->with('success',trans('created_succesfully'));

    }

    public function destroySocialLink(Request $request,$id){
        $filename=DB::table('social_links')->where('id',$id)->first()->icon;
         unlink(storage_path("app/public/logos/".$filename));
        DB::table('social_links')->where('id',$id)->delete();
        return redirect()->back()->with('success',trans('removed_succesfully'));

    }

    // public function activateSocialIcon(){

    // }
}
