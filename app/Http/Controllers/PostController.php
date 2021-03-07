<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $posts = Post::withCount('Comments')->get();
            return datatables()->of($posts)->make(true);
        }

        $cats = DB::table('categories')->get();
        return view('posts.index', compact( 'cats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:55',
            'keywords' => 'required|max:55',
            'content' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'image_file' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        $post = new Post();
        $post->author_id = auth()->user()->id;
        $post->title = $request->title;
        $post->keywords = $request->keywords;
        $post->content = $request->content;
        $post->description = $request->description;
        $post->category_id = $request->category_id;
        $post->slug = $this->createSlug($post->title);
        $filename = time() . "." . $request->file('image_file')->getClientOriginalExtension();
        $request->file('image_file')->storeAs("public/posts/$post->id", $filename);
        $post->img_file = $filename;
        $post->save();

        return redirect()->back()->with('success', trans('correctly saved'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if ($post->author_id === auth()->user()->id) {
            $cats = DB::table('categories')->get();
            return view('posts.edit', compact('post', 'cats'));
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:55',
            'keywords' => 'required|max:33',
            'content' => 'required',
            'category' => 'required',
            'description' => 'required',
            'image_file' => 'sometimes|image|mimes:jpg,jpeg,png',
        ]);

        if ($post->author_id === auth()->user()->id) {
            $request['category'] = $post->category_id;

            if ($post->title != $request->title) {
                $post->slug = $this->createSlug($request->title);
                $post->save();
            }



            if ($request->hasfile('image_file')) {
                $filename = time() . "." . $request->file('image_file')->getClientOriginalExtension();
                $request->file('image_file')->storeAs("public/posts", $filename);
                $post->img_file = $filename;
                $post->save();
            }

            $post->update($request->except(['_token', '_method', 'category', 'image_file']));

            return redirect()->route('posts.index')->with('success', trans('correctly saved'));
        }
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $removed = Storage::delete("public/posts/" . $post->img_file);
        if (!$removed) {

            return redirect()->back()->with('error', trans('image_not_removed'));
        }
        $comments= $post->Comments;
        foreach ($comments as $key => $com) {
            $com->delete();
        }

        $post->delete();
        return response()->json(['success', trans('removed_success')]);
    }

    public static function generateTinyUrl()
    {
        $length = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomCode = '';
        for ($i = 0; $i < $length; $i++) {
            $randomCode .= $characters[rand(0, $charactersLength - 1)];
        }

        // Checks code already generated
        $codeAlreadyExist = DB::table('posts')->where('slug', $randomCode)->exists();
        if ($codeAlreadyExist) {
            return self::generateTinyUrl();
        } else {
            return $randomCode;
        }
    }

    public function createSlug($str)
    {

        $str = strtolower(trim($str));
        $str = preg_replace('/[^a-z0-9-]/', '-', $str);
        $str = preg_replace('/-+/', "-", $str);
        $tinycode = self::generateTinyUrl();
        $slug = $str . "-" . $tinycode;
        return $slug;
    }
}
