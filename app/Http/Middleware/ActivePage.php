<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivePage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $page=$request->path();
        $active=DB::table('pages_content')->where('name',$page)->first()->active;
        if($active){
            return $next($request);

        }
        abort(404);
    }
}
