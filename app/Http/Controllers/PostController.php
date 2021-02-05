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
    public function index()
    {
        $posts= Post::where('author_id',auth()->user()->id)->get();
        $cats= DB::table('categories')->get();
        return view('posts.index',compact('posts','cats'));
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
            'title'=>'required|max:33',
            'keywords'=>'required|max:33',
            'content'=>'required',
            'description'=>'required',
            'image_file'=>'required|image|mimes:jpg,jpeg,png',
        ]);

        $post = new Post();
        $post->author_id= auth()->user()->id;
        $post->title = $request->title;
        $post->keywords = $request->keywords;
        $post->content = $request->content;
        $post->description = $request->description;
        $post->category_id = $request->category;

        $filename= time().".".$request->file('image_file')->getClientOriginalExtension();
        $request->file('image_file')->storeAs("images/posts", $filename);
        $post->img_file= $filename;
        $post->save();
        //Storage::putAs(filePath, $contents);
        return redirect()->back()->with('success',trans('correctly saved'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
