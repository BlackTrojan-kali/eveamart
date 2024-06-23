<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifyOwnershipMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->id;
        $can = false;
            if(isset(Auth::guard('admin')->user()->isRulingMart)){
                foreach(Auth::guard("admin")->user()->isRulingMart as $mart){
                    if($mart->id == $id){
                        $can = true;
                    }
                }
                if($can){
                    return $next($request);
                }else{
                   
                  return back()->withErrors("You are not authorize to modify this mart");
                }

            }

        return $next($request);
    }
}
