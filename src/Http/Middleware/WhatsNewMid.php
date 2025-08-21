<?php

namespace Pro1\Changelog\Http\Middleware;

use Closure;
use Pro1\Changelog\Models\WhatsNew;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WhatsNewMid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        
        if (
            $request->is('login') ||
            $request->is('register') ||
            $request->is('password/*') ||
            $request->is('logout')
        ) {
            return $next($request);
        }

        if ($request->is('changelogs*')) {
            return $next($request);
        }

        if ($request->is('/')) {
            return redirect()->route('login');
        }


        if($whatsnew = $this->userwhatnew()){
            return redirect()->route('changelogs.show',$whatsnew->change_log_id);
        }


        return $next($request);
    }

    public function userwhatnew(){
        $user = Auth::user();
        $user_id = $user->id;
        $whatnew = WhatsNew::where("user_id",$user_id)
        ->where('read_at',null)
        ->orderby("id",'desc')
        ->first();

        return $whatnew;
    }
}
