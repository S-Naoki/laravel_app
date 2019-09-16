<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $maxAttempts = 3; //ログイン試行回数指定
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/todo';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //middleware('guest')でguestというミドルウェアを実行している。
    //'guest'ミドルウェアはRedirectIfAuthenticatedに紐付られてる。
    //ログイン済みの状態でログインページにアクセスすると、ログイン後のトップページにリダイレクトする。
    //except('logout')と指定することでlogout()を呼び出してlogout処理をしている。この記述がないとログアウトできない。
    //middleware()はControllerMiddlewareOptionsオブジェクトを返す
    //except()でlogoutはログイン中の’guest’ミドルウェアからは除きます。つまりログイン中にログアウトできるようになる。
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //ログアウトメソッドのオーバーライド（親クラスで定義されたメソッドを子クラスで再定義してあげることで、動作を上書きすること）
    //今回はログアウトのリダイレクト先をloginに変更したいので、loggedOut()をオーバーライドしている。
    protected function loggedOut(Request $request)
    {
        return redirect('/login');
    }
}
