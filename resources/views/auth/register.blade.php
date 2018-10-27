@extends('layouts.user')

@section('content')
    <style type="text/css">
        /* Register*/
        .reg-wrap{
            width: 100%;
            height: 650px;
            border: 1px solid #EBEBEB;
        }

        /* Register Banner*/
        .reg-banner{
            width: 500px;
            height: 650px;
            background: url('http://ov1pmduk7.bkt.clouddn.com/banner_registe.png') no-repeat;
        }

        /* Register Form*/
        .reg-form{
            width: 700px;
        }

        /* Register Title*/
        .reg-title{
            margin: 40px 0 40px 40px;
            font-size: 16px;
            font-weight: bolder;
        }

        /* Register Item*/
        .reg-item {
            width: 455px;
            margin: 0 auto 15px auto;
        }
        .reg-item .item-title{
            margin-right: 15px;
            height: 28px;
            line-height: 28px;
            font-size: 14px;
            color: #555555;
        }
        .reg-item .item-title span{
            color: #CC0000;
        }
        .reg-item .item-input input{
            padding: 0px 10px;
            margin-bottom: 5px;
            width: 330px;
            height: 28px;
            border: 1px solid #C3C3C7;
            border-radius: 2px;
        }
        .reg-item .item-input p{
            color: #999999;
            font-size: 12px;
        }
        .reg-item #reg_verification{
            margin-left: 80px;
        }
        .reg-item .geetest_holder.geetest_wind{
            width: 352px !important;
        }
        .reg-item .wait-dot, .reg-item .wait-text{
            width: 350px !important;
        }
        .reg-item input.verification-input{
            width: 210px;
        }
        .reg-item .btn-verification{
            vertical-align: top;
            margin-left: 5px;
            width: 110px;
            height: 30px;
            font-size: 12px;
            color: #626266;
            border: 1px solid #C3C3C7;
            border-radius: 2px;
            background: -webkit-linear-gradient(#FFFFFF, #E6E6EA); /* Safari 5.1 - 6.0 */
            background: -o-linear-gradient(#FFFFFF, #E6E6EA); /* Opera 11.1 - 12.0 */
            background: -moz-linear-gradient(#FFFFFF, #E6E6EA); /* Firefox 3.6 - 15 */
            background: linear-gradient(#FFFFFF, #E6E6EA); /* 标准的语法 */
        }
        .reg-item .checkbox-wrap{
            margin-left: 82px;
            color: #595959;
            font-size: 12px;
            cursor: default;
        }
        .reg-item .checkbox-wrap input{
            cursor: pointer;
        }
        .reg-item .checkbox-wrap a{
            color: #10409F;
        }
        .reg-item .checkbox-wrap a:hover{
            color: #10409F;
            text-decoration: underline;
        }

        /* Register Button*/
        .btn-reg{
            margin-left: 80px;
            width: 350px;
            height: 42px;
            font-size: 18px;
            font-weight: bolder;
        }

        /* Login Link*/
        .login-link{
            width: 407px;
            margin: 0 auto;
            color: #595959;
            font-size: 12px;
            text-align: right;
        }
        .login-link a{
            color: #FF4401;
        }
    </style>
    <div class="f-wrap">
        <div class="reg-wrap f-cb">
            <div class="reg-form f-fl">
                <h3 class="reg-title">请填写账号注册信息</h3>
                <form method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}


                    <div class="reg-item f-cb">
                        <div class="item-title f-fl"><span>*</span> 登录账号</div>
                        <div class="item-input f-fl">
                            <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus/>
                            <p>6~18个字符，可使用字母、数字、下划线，需以字母开头</p>
                        </div>
                    </div>
                    <div class="reg-item f-cb">
                        <div class="item-title f-fl"><span>*</span> 登录密码</div>
                        <div class="item-input f-fl">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                            <input id="password" type="password" name="password" required/>
                            <p>6~16个字符，区分大小写</p>
                        </div>
                    </div>
                    <div class="reg-item f-cb">
                        <div class="item-title f-fl"><span>*</span> 密码确认</div>
                        <div class="item-input f-fl">
                            <input id="password-confirm" type="password" name="password_confirmation" required/>
                            <p>请再次填写密码</p>
                        </div>
                    </div>
                    <div class="reg-item f-cb">
                        <div class="item-title f-fl"><span>*</span> 手机号码</div>
                        <div class="item-input f-fl">
                            <input id="tel" type="tel" name="tel"/>
                            <p>忘记密码时，可以通过该手机号码快速找回密码</p>
                        </div>
                    </div>
                    <div class="reg-item">
                        <!-- {!! Geetest::render('float', 'reg_verification') !!} -->
                    </div>
                    <div class="reg-item f-cb">
                        <div class="item-title f-fl"><span>*</span> 短信验证</div>
                        <div class="item-input f-fl">
                            <input id="SMScode" class="verification-input" type="text" name="SMScode" />
                            <button class="btn-verification">获取短信验证码</button>
                            <p>请查收手机短信，并填写短信中的验证码</p>
                        </div>
                    </div>
                    <div class="reg-item">
                            <span class="checkbox-wrap">
                                <input type="checkbox" required/>
                                <span>阅读并同意<a href="#" target="_blank">《蚂蚁海淘服务协议》</a>和<a href="#" target="_blank">《隐私权相关政策》</a></span>
                            </span>
                    </div>
                    <div class="reg-item">
                        <button type="submit" class="btn btn-reg">同意协议并注册</button>
                    </div>
                </form>
                <div class="login-link">已有账号？<a href="{{ route('login') }}">立即登录</a></div>
            </div>
            <div class="reg-banner f-fr"></div>
        </div>
    </div>
@endsection
