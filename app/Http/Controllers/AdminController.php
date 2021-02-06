<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
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
}
