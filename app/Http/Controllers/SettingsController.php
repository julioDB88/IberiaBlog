<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{

    public function index(){
        $cats= Category::all(); ;
        $social= DB::table('social_links')->get();
        $sections= DB::table('pages_content')->get();

        return view('pages.features.settings',compact('cats','social','sections'));

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

}
