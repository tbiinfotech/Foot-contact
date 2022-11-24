<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardAccess
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
        $user = Auth::user();
        if($user){
            $user_detail = User::where([
                'id' => Auth::user()->id,
                'verified' => '1'
            ])->first();
            if (!empty($user_detail)) {
                $user_role_id = Auth::user()->role_id;
                if ($user_role_id == 1 || $user_role_id == 2) {
                    return $next($request);
                } 
                auth()->logout();
                return redirect('/login');
            }
            auth()->logout();
        }
       
            return redirect('/login');
    }
}
