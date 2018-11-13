<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Cache;

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
            'geetest_challenge' => 'required|geetest',
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

    public function smsLogin(Request $request)
    {
        $this->validate($request, [
            'mobile' => [
                'required',
                'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199|(147))\d{8}$/'
            ],
            'sms_key' => 'required|string',
            'sms_code' => 'required|string',
        ], [
            'sms_key.required' => '极验证码错误'
        ]);

        $smsData = Cache::get($request['sms_key']);

        if (!$smsData) {
            session()->flash('error', '短信验证码已失效');
            return redirect()->back();
        } else if (!hash_equals($smsData['mobile'], $request['mobile'])) {
            session()->flash('error', '注册手机号与短信验证手机号不一致');
            return redirect()->back();
        } else if (!hash_equals($smsData['code'], $request['sms_code'])) {
            session()->flash('error', '短信验证码错误');
            return redirect()->back();
        } else {
            $user = User::where('mobile', $smsData['mobile'])->first();
            // 清除验证码缓存
            Cache::forget($request['sms_key']);
            $remember = false;
            if ($request->remember == 'on') {
                $remember = true;
            }
            return $this->guard()->login($user, $remember)
                ?: redirect()->intended($this->redirectPath());
        }
    }
}
