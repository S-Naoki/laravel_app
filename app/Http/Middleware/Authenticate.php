<?php
//ミドルウェアauth
namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    //ここでログイン状態をチェックしている。
    //リダイレクト先をloginフォームに指定している。
    protected function redirectTo($request)
    {
        return route('login');
    }
}
