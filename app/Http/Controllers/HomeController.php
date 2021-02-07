<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    protected $admin_email;

    public function __construct()
    {
        $email =DB::table('pages_content')->where('page','contact')->first()->content;

        $this->admin_email = $email === 'null' ? config('app.email') : $email;
    }

    public function index(){

        $latest_posts= Post::take(6)->get();
        $top_comment=Post::withCount('Comments')->take(6)->get();
        //related algorithm
        $related =Post::whereMonth('created_at',Carbon::now()->month)->take(6)->inRandomOrder()->get();
        return view('guest.home',compact('latest_posts','top_comment','related'));

    }
    public function showCategoryNews($slug){
        $cat= Category::where('slug',$slug)->first();
        if(!$cat){
         return abort(404)    ;
        }
        $category= $cat->name;
        $posts= Post::where('category_id',$cat->id)->orderBy('id','desc')->get();
        return view('guest.pages.newscategory',compact('posts','category'));

    }

    public function showNews($slug){
        $post= Post::where('slug',$slug)->first();
        if($post){
            $comments= $post->Comments;
            return view('guest.showpost',compact('post','comments'));
        }
        abort(404);
    }

    public function showPage($page){
        $content= DB::table('pages_content')->where('page',$page)->first();
        if (view()->exists("guest.pages.{$page}")) {
            return view("guest.pages.{$page}",compact('content'));
        }

        return abort(404);
    }
    public function showLegal($page){

        if (view()->exists("guest.legal.{$page}")) {
            return view("guest.legal.{$page}");
        }
        return abort(404);
    }
    public function contactMe(Request $request){

        $request->validate([
            'terms'=>'accepted',
            'name'=>'required|max:45|string',
            'email2'=>'required|email',
            'message2'=>'required|string'
        ]);

        if($request->email || $request->message || $request->message){
            return redirect()->back()->with('success','Enviado Correctamente');
        }
        $data= array(
            'name'=>$request->name,
            'email'=>$request->email2,
            'message'=>$request->message2
        );

        Mail::to($this->admin_email)->send(new ContactMail($data));
        return redirect()->back()->with('success','Enviado Correctamente');

    }

    public function storeComment(Request $request){

        $request->validate([
            'name2'=>'required|string|max:25',
            'email2'=>'required|email',
            'text'=>'required|max:300|string'
        ]);

        if($request->name || $request->email){
            return redirect()->back()->with('success',trans('Your comment will be reviewed soonly and published if commplies with our policies'));

        }
        $com = new Comment();
        $com->name= $request->name2;
        $com->email= $request->email2;
        $com->post_id= $request->post_id;
        $com->comment= $request->text;
        $com->visible=0;
        $com->save();

        return redirect()->back()->with('success',trans('Your comment will be reviewed soonly and published if commplies with our policies'));
    }
}
