<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
           $comments = auth()->user()->role_id===0 ?
                Comment::with('Post')->get():
                Comment::with('Post')->whereHas('Post',function($query){
                    $query->where('posts.author_id',auth()->user()->id);
                })->get();

            return datatables()->of($comments)->make(true);
        }




        return view('pages.comments');
    }

    public function switchVisible(Request $request)
    {
        if($request->ajax()){
            $comment=Comment::where('id',$request->comment)->first();
            $switch = $comment->visible===1 ? 0:1;
            $comment->visible=$switch;
            $comment->save();


        }
        return response()->json('ok',200);
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
            'name2' => 'required|string|max:25',
            'email2' => 'required|email',
            'text' => 'required|string'
        ]);
            //honey pots for spammers
        if ($request->name || $request->email) {
            return redirect()->back()->with('success', trans('Your comment will be reviewed soonly and published if commplies with our policies'));
        }
        $com = new Comment();
        $com->name = $request->name2;
        $com->email = $request->email2;
        $com->post_id = $request->post_id;
        $com->comment = $request->text;
        $com->visible = 0;
        $com->save();

        return redirect()->back()->with('success', trans('Your comment will be reviewed soonly and published if commplies with our policies'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
    }
}
