@extends('layouts.user')

@section('content')
    <div class="login-adbg">
        <div class="f-wrap">
            <a class="login-adlink" href="#"></a>
            <!-- 登录面板 -->
            <div class="login-wrap">
                <!-- 扫码登录与常规登录切换 -->
                <div class="toggle-wrap">
                    <img class="scan-tips" src="{{ URL::asset('fonts/login_tips.svg') }}" alt="">
                    <div class="btn-toggle"></div>
                </div>
                <!-- END 扫码登录与常规登录切换 -->

                <!-- 常规登录方式 -->
                <div class="normal-login">
                    <!-- 常规登录头部 -->
                    <div class="login-header">
                        <ul class="tabs">
                            <li class="tabs-item tabs-active">账号密码登录</li>
                            <li class="tabs-item">手机动态登录</li>
                        </ul>
                        <div class="hot-line"></div>
                    </div>
                    <!-- END 常规登录头部 -->

                    <div class="login-panel">
                        <!-- 账号密码登录-->
                        <div class="tabs-panel tabs-panel-active login-password-panel">
                            <form method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}

                                <div class="input-group">
                                    <span class="input-group-img"><img src="{{ URL::asset('fonts/icon_user.svg') }}"></span>
                                    <input id="username" type="text" placeholder="账号名/邮箱/手机号" name="username" required/>
                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="input-group">
                                    <span class="input-group-img"><img src="{{ URL::asset('fonts/icon_lock.svg') }}"></span>
                                    <input id="password" type="password" placeholder="密码" name="password" required/>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <!-- {!! Geetest::render('float', 'pwd-verification') !!} -->
                                <div class="login-other-info">
                              <span class="checkbox-wrap">
                                <input type="checkbox"/>
                                <span class="checkbox-text">两周内自动登录</span>
                              </span>
                                    <a href="#">忘记密码</a>
                                </div>
                                <button type="submit" class="btn btn-login">登&nbsp;录</button>
                            </form>
                        </div>
                        <!-- END 账号密码登录 -->

                        <!-- 手机动态登录 -->
                        <div class="tabs-panel login-mobile-panel">
                            <form>
                                <div class="input-group">
                                    <span class="input-group-img"><img src="{{ URL::asset('fonts/icon_mobile.svg') }}"></span>
                                    <input type="text" placeholder="手机号" />
                                </div>
                                {!! Geetest::render('float', 'mobile-verification') !!}
                                <div class="verification-wrap">
                                    <div class="input-group verification-input">
                                        <span class="input-group-img"><img src="{{ URL::asset('fonts/icon_safe.svg') }}"></span>
                                        <input type="text" placeholder="短信验证码" />
                                    </div>
                                    <button class="btn btn-verification">短信验证</button>
                                </div>
                                <div class="login-other-info">
                              <span class="checkbox-wrap">
                                <input type="checkbox"/>
                                <span class="checkbox-text">两周内自动登录</span>
                              </span>
                                </div>
                                <button class="btn btn-login">登&nbsp;录</button>
                            </form>
                        </div>
                        <!-- END 手机动态登录-->

                        <!-- 使用其他账号登录 -->
                        <div class="login-bottom">
                            <div class="other-ways">
                                <p>使用其他账号登录</p>
                                <div class="auth-login">
                                    <a class="auth-link" href="#"><img src="{{ URL::asset('fonts/icon_weibo.svg') }}" alt=""></a>
                                    <a class="auth-link" href="#"><img src="{{ URL::asset('fonts/icon_qq.svg') }}" alt=""></a>
                                    <a class="auth-link" href="#"><img src="{{ URL::asset('fonts/icon_wx.svg') }}" alt=""></a>
                                    <a class="register-link" href="{{ route('register') }}">注册新账号></a>
                                </div>
                            </div>
                        </div>
                        <!-- END 使用其他账号登录 -->

                    </div>
                </div>
                <!-- END 常规登录方式 -->

                <!-- 扫码登录方式 -->
                <div class="scan-login">
                    <h3 class="scan-title">手机扫码，安全登录</h3>
                    <img class="img-qrcode" src="{{ URL::asset('fonts/qrcode.svg') }}" alt="">
                    <img class="img-tips" src="{{ URL::asset('fonts/scan_tips.svg') }}" alt="">
                    <div class="link-wrap">
                        <a class="toggle-pwd">密码登录</a>
                        <a href="{{ route('register') }}">免费注册</a>
                    </div>
                </div>
                <!-- END 扫码登录方式 -->

            </div>
        </div>
    </div>

    <style type="text/css">
        /* Login */
        .login-adbg{
            width: 100%;
            height: 500px;
            background: url("http://ov1pmduk7.bkt.clouddn.com/banner_login.png") no-repeat center center;
            background-size: cover;
        }
        .login-adlink{
            position: absolute;
            top: 0px;
            left: 0px;
            width: 800px;
            height: 500px;
        }
        .login-wrap{
            position: absolute;
            top: 40px;
            right: 60px;
            width: 350px;
            height: 428px;
            background-color: rgba(255, 255, 255, .95)
        }

        /* Toggle Scan */
        .toggle-wrap{
            position: absolute;
            top: 5px;
            right: 5px;
        }
        .toggle-wrap .scan-tips{
            position: relative;
            top: 0px;
            right: 52px;
        }
        .btn-toggle{
            position: absolute;
            top: 0px;
            right: 0px;
            width: 52px;
            height: 52px;
            cursor: pointer;
            background: url("{{ URL::asset('fonts/half_qrcode.svg') }}") no-repeat right top;
            -webkit-user-select:none;
            -moz-user-select:none;
            -ms-user-select:none;
            user-select:none;
        }

        /* Scan Login */
        .scan-login{
            display: none;
        }
        .scan-login .scan-title{
            margin: 25px 0 0 30px;
            font-size: 16px;
            font-weight: bolder;
        }
        .scan-login img{
            display: block;
            margin: 0 auto;
        }
        .scan-login .img-qrcode{
            margin-top: 55px;
            margin-bottom: 25px;
        }
        .scan-login .link-wrap {
            position: absolute;
            right: 30px;
            bottom: 25px;
            font-size: 12px;
        }
        .scan-login .link-wrap a {
            margin-right: 10px;
            color: #6C6C6C;
            cursor: pointer;
        }
        .scan-login .link-wrap a:hover {
            color: #FF4401;
            text-decoration: underline;
        }

        /* Normal Login Header */
        .login-header{
            width: 290px;
            height: 65px;
            margin: 0 auto;
        }
        .login-header ul{
            margin-top: 15px;
            height: 50px;
            line-height: 50px;
            text-align: center;
            font-size: 16px;
            color: #97979B;
            border-bottom: 1px solid #DCDCDF;
        }
        .login-header li{
            float: left;
            width: 145px;
            cursor: pointer;
        }
        .login-header li.tabs-active{
            color: #333333;
            font-weight: bolder;
        }
        .login-header .hot-line{
            position: relative;
            left: 0px;
            top: -2px;
            width: 145px;
            height: 2px;
            background-color: #FF4401;
            transition:all .3s;
        }

        /* Login Panel */
        .login-panel{
            width: 290px;
            margin: 0 auto;
        }
        .login-panel .tabs-panel{
            float: left;
            display: none;
        }
        .login-panel .tabs-panel-active{
            display: block;
        }

        /* Login Input */
        .input-group {
            display: flex;
            width: 290px;
            height: 38px;
            background-color: #ffffff;
            border: 1px solid #C3C3C7;
            border-radius: 2px;
            margin-bottom: 10px;
        }
        .input-group .input-group-img{
            display: flex;
            width: 38px;
            height: 38px;
            background-color: #D3D3D8;
        }
        .input-group .input-group-img img{
            margin: 0 auto;
        }
        .input-group input{
            position: relative;
            flex: 1 1 auto;
            width: 1%; /* 不设置宽度，调整input-group宽度会产生挤压 */
            border: 0;
            border-radius: 0 2px 2px 0;
            padding: 9px 12px;
            font-size: 14px;
            color: #333333;
        }

        /* Other Login Info */
        .login-other-info{
            position: relative;
            margin-top: 10px;
            font-size: 12px;
            color: #575656;
        }
        .login-other-info a{
            position: absolute;
            right: 0;
            color: #575656;
        }
        .login-other-info a:hover{
            color: #FF4401;
            text-decoration: underline;
        }

        /* Login Button */
        .btn-login{
            margin-top: 20px;
            width: 100%;
            height: 42px;
            font-size: 18px;
            font-weight: bolder;
        }

        /* Login Verification Button */
        .login-wrap .btn-verification{
            position: absolute;
            top: 0px;
            right: 0px;;
            width: 90px;
            height: 38px;
            font-size: 14px;
        }

        /* Verification Input */
        .verification-wrap{
            position: relative;
            margin-top: 10px;
        }
        .verification-input{
            width: 190px;
        }

        /* Login Bottom */
        .login-bottom{
            position: absolute;
            left: 0px;
            bottom: 0px;
            width: 100%;
            height: 80px;
            color: #97979D;
            font-size: 12px;
            background-color: rgba(240, 240, 240, .95);
        }
        .login-bottom p{
            margin: 15px 0 8px 0;
        }
        .login-bottom .other-ways{
            position: relative;
            width: 290px;
            margin: 0 auto;
        }
        .login-bottom .auth-link{
            margin-right: 8px;
        }
        .login-bottom .register-link{
            position: absolute;
            right: 0px;
            bottom: 0px;
            color: #FF4401;
        }
        .login-bottom a.register-link:hover{
            text-decoration: underline;
        }
    </style>
@endsection