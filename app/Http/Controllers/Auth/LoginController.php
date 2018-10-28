<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string|min:6|max:18',
            'password' => 'required|string|min:6|max:16',
            'geetest_challenge' => 'geetest',
        ], [
            'geetest' => config('geetest.server_fail_alert')
        ]);
    }

    protected function sendLoginResponse(Request $request)
    {
        if ($request->filled('remember')) {
            // 设置记住我的时间为1周内，7天 * 24 小时 * 60分钟
            $rememberTokenExpireMinutes = 10080;

            // 首先获取 记住我 这个 Cookie 的名字, 这个名字一般是随机生成的,
            // 类似 remember_web_59ba36addc2b2f9401580f014c7f58ea4e30989d
            $rememberTokenName = Auth::getRecallerName();

            // 获取Cookie的值，使用Cookie::get($rememberTokenName)的值是空的
            // 参考https://stackoverflow.com/questions/44669541/how-to-modify-remember-me-expired-time-in-laravel-5-2
            $cookieJar = $this->guard()->getCookieJar();
            $cookieValue = $cookieJar->queued($rememberTokenName)->getValue();

            // 再次设置一次这个 Cookie 的过期时间
            Cookie::queue($rememberTokenName, $cookieValue, $rememberTokenExpireMinutes);
        }

        // 下面的代码是从 AuthenticatesUsers 中的 sendLoginResponse() 直接复制而来
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }
}
