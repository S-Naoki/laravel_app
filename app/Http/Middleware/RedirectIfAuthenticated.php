<?php
//ミドルウェアguest
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    //ログインしている場合に/homeにリダイレクトする処理。
    //check()でユーザーが既にログインしているかを判定している。
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect('/todo');
        }

        return $next($request);
    }
}
