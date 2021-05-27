<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    protected $admin_email;
    public $chronology;


    /**
     * take the email for contact purposes
     */

    public function __construct()
    {

        $this->admin_email = config('app.email') ;
        $this->chronology = Post::where('active',1)->whereYear('publish_at',Carbon::now()->year)->get(['slug','title','publish_at'])->groupBy(function($item){
            return Carbon::parse($item->publish_at)->format('Y-m');
        });

    }

    /**
     * show some posts in home page for guest
     */

    public function index()
    {

        $latest_posts = Post::where('active',1)->where('publish_at','<=',Carbon::now())->take(6)->orderBy('id', 'desc')->get();
        $top_comment = Post::where('active',1)->where('publish_at','<=',Carbon::now())->whereYear('publish_at',Carbon::now()->year)->withCount('Comments')->orderBy('comments_count','desc')->take(6)->get();
        $related = Post::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->where('active',1)->where('publish_at','<=',Carbon::today())->take(6)->inRandomOrder()->get();
        $chrono = $this->chronology;

        return view('guest.home', compact('latest_posts', 'top_comment', 'related','chrono'));
    }

    /**
     * show some posts with same category
     */
    public function showCategoryNews($slug)
    {
        $cat = Category::where('slug', $slug)->first();
        if (!$cat) {
            return abort(404);
        }
        $category = $cat->name;
        $posts = Post::where('category_id', $cat->id)->where('publish_at','<=',Carbon::today())->where('active',1)->orderBy('id', 'desc')->paginate(9);
        return view('guest.newscategory', compact('posts', 'category'));
    }
        /**
     * show some posts in same month
     */
    public function showMonthNews($date)
    {
        $month=Carbon::parse($date)->month;
        $year=Carbon::parse($date)->year;
        $posts = Post::whereMonth('publish_at',$month)->whereYear('publish_at',$year)->where('active',1)->orderBy('id', 'desc')->paginate(9);
        if (empty($posts)) {
            return abort(404);
        }
        return view('guest.newschrono', compact('posts','date'));
    }
    /**
     * show the specified post
     */
    public function showNews($slug)
    {
        $post = Post::with('Comments')->where('slug', $slug)->first();
        $chrono = $this->chronology;
        if ($post && $post->active==1 && $post->publish_at <= Carbon::now()) {

            $related = Post::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->where('active',1)
            ->where('publish_at','<=',Carbon::today())
            ->take(6)->inRandomOrder()->get();

            return view('guest.showpost', compact('post', 'related','chrono'));
        }else if(Auth::check()){
            $related = Post::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->where('active',1)
            ->where('publish_at','<=',Carbon::today())
            ->take(6)->inRandomOrder()->get();

            return view('guest.showpost', compact('post', 'related','chrono'));
        } else{
            abort(404);
        }

    }

    /**
     * show the specified page: about,contact,settings
     */
    public function showVideos()
    {

        $vids = DB::table('videos')->orderBy('id','desc')->paginate(15);
        return view('guest.pages.videos', compact('vids'));

        return abort(404);
    }

    //show
    public function showContact()
    {

        return view("guest.pages.contact");
    }
    public function showAbout()
    {
        $content2 = 'mola';DB::table('pages_content')->where('id',2)->first()->content;
        return view("guest.pages.about",compact('content2'));
    }

    //show
    public function showShop()
    {


        return view("guest.pages.contact");
    }

    //show legal pages: terms or policy
    public function showLegal($page)
    {

        if (view()->exists("guest.legal.{$page}")) {
            return view("guest.legal.{$page}");
        }
        return abort(404);
    }

    // show posts with terms from the search bar

    public function searchPosts(Request $request)
    {
        $words = strtolower($request->search);

        if (strlen($words) > 3) {
            $posts = Post::where('title', 'like', "%$words%")->orWhere('content', 'like', "%$words%")->get();
        }
        if (!isset($posts) || !count($posts)) {
            $posts = Post::inRandomOrder()->take(10)->get();
        }

        $category = trans('Related search');

        return view('guest.pages.newscategory', compact('posts', 'category'));
    }

    //contact function to send email to blog owner
    public function contactMe(Request $request)
    {

        $request->validate([
            'terms' => 'accepted',
            'name' => 'required|max:45|string',
            'email2' => 'required|email',
            'message2' => 'required|string'
        ]);
        //honey pots for spammers
        if ($request->email || $request->address || $request->message) {
            return redirect()->back()->with('success', 'Enviado Correctamente');
        }
        $data = array(
            'name' => $request->name,
            'email' => $request->email2,
            'message' => $request->message2
        );

        Mail::to($this->admin_email)->send(new ContactMail($data));
        return redirect()->back()->with('success', 'Enviado Correctamente');
    }

    //stores the user comment


}
