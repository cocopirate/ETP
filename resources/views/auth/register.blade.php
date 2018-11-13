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
        .reg-item input.btn-verification{
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
            cursor: pointer;
        }
        .reg-item input.btn-disable{
            background: #F5F5F5;
            border: 1px solid #BBBBBB;
            color: #999999;
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

        /* Wrong Tips*/
        .tips-danger{
            position: relative;
            left: 204px;
            width: 350px;
            height: 22px;
            line-height: 22px;
            border: 1px solid #E7AF6F;
            background-color: #F7E6DF;
            color: #67686C;
            font-size: 12px;
            margin-bottom: 10px;
        }
        .tips-danger img{
            margin-left: 8px;
            margin-right: 3px;
            vertical-align: middle;
        }
    </style>
    <div class="f-wrap">
        <div class="reg-wrap f-cb">
            <div class="reg-form f-fl">
                <h3 class="reg-title">请填写账号注册信息</h3>
                <form method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <!-- 错误提示 -->
                    @if (count($errors) > 0)
                        <div class="tips-danger">
                            <img src="{{ URL::asset('fonts/icon_wrong.svg') }}" alt="">
                            <span>{{ $errors->first()}}</span>
                        </div>
                    @endif
                    <!-- END 错误提示 -->
                    <!-- 消息反馈 -->
                    @foreach (['error', 'warning', 'success', 'info'] as $msg)
                        @if (session()->has($msg))
                            <div class="tips-danger">
                                <img src="{{ URL::asset('fonts/icon_wrong.svg') }}" alt="">
                                <span>{{ session()->get($msg)}}</span>
                            </div>
                        @endif
                    @endforeach
                    <!-- END 消息反馈 -->

                    <div class="reg-item f-cb">
                        <div class="item-title f-fl"><span>*</span> 登录账号</div>
                        <div class="item-input f-fl">
                            <input id="username" type="text" name="username" value="{{ old('username') }}" autofocus/>
                            <p>6~18个字符，可使用字母、数字、下划线，需以字母开头</p>
                        </div>
                    </div>
                    <div class="reg-item f-cb">
                        <div class="item-title f-fl"><span>*</span> 登录密码</div>
                        <div class="item-input f-fl">
                            <input id="password" type="password" name="password" />
                            <p>6~16个字符，区分大小写</p>
                        </div>
                    </div>
                    <div class="reg-item f-cb">
                        <div class="item-title f-fl"><span>*</span> 密码确认</div>
                        <div class="item-input f-fl">
                            <input id="password-confirm" type="password" name="password_confirmation" />
                            <p>请再次填写密码</p>
                        </div>
                    </div>
                    <div class="reg-item f-cb">
                        <div class="item-title f-fl"><span>*</span> 手机号码</div>
                        <div class="item-input f-fl">
                            <input id="mobile" type="tel" name="mobile"/>
                            <p>忘记密码时，可以通过该手机号码快速找回密码</p>
                        </div>
                    </div>
                    <div class="reg-item">
                        {!! Geetest::render('float', 'reg_verification') !!}
                    </div>
                    <div class="reg-item f-cb">
                        <div class="item-title f-fl"><span>*</span> 短信验证</div>
                        <div class="item-input f-fl">
                            <input id="sms_code" class="verification-input" type="text" name="sms_code" />
                            <input id="sms_btn" type="button" class="btn-verification" value="获取短信验证码"/>
                            <input id="sms_key" name="sms_key" type="hidden"/>
                            <p>请查收手机短信，并填写短信中的验证码</p>
                        </div>
                    </div>
                    <div class="reg-item">
                            <span class="checkbox-wrap">
                                <input name="agree_check" type="checkbox" />
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
    <script>
        
        function showMsg(obj, msg) {
            var dlgDiv = '<div class="tips-danger"><img src="{{ URL::asset('fonts/icon_wrong.svg') }}" alt=""><span>' + msg + '</span></div>';
            $('.tips-danger').remove();
            obj.prepend(dlgDiv);
        }

        // 获取对象第一个元素，用于前端错误表达
        function getObjFirst(obj){
            for(let i in obj) return obj[i];
        }

        function sms_button(obj, time){
            var i = setInterval(function(){
                time--;
                if(time >= 0){
                    obj.attr('disabled',"disabled");
                    obj.addClass('btn-disable');
                    obj.val('重发验证码(' + time + ')');
                } else {
                    obj.removeClass('btn-disable');
                    obj.attr('disabled',false);
                    obj.val('获取短信验证码');
                    clearInterval(i);
                }
            },1000);
        }

        $(function () {
            // 检测发送验证码的按钮是否可用
            var clickTime = localStorage.getItem('clickTime');
            var nowTime = new Date().getTime();
            var time = parseInt({{ Config::get('app.sms_limit_time')}}) - parseInt((nowTime - parseInt(clickTime)) / 1000);
            if (time <= parseInt({{ Config::get('app.sms_limit_time')}}) && time > 0) {
                sms_button($('#sms_btn'), time);
            }

            // 发送验证码点击事件
            $('#sms_btn').click(function () {

                var mobile = $('input[name="mobile"]').val();
                var geetest_challenge = $('input[name="geetest_challenge"]').val();
                var geetest_validate = $('input[name="geetest_validate"]').val();
                var geetest_seccode = $('input[name="geetest_seccode"]').val();

                // 判断是否填写手机号
                if (mobile) {
                    var telReg = mobile.match(/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/);
                    // 判断手机号格式是否正确
                    if (telReg) {
                        // 判断是否完成极验证
                        if ( geetest_challenge && geetest_validate && geetest_seccode ) {
                            $.ajax({
                                url: '/geetest/validate',
                                type: 'post',
                                data: {
                                    _token: '{{csrf_token()}}',
                                    mobile: mobile,
                                    'geetest_challenge': geetest_challenge,
                                    'geetest_validate': geetest_validate,
                                    'geetest_seccode': geetest_seccode
                                },
                                dataType: "json",
                                success: function(data) {
                                    $('#sms_btn').attr('disabled',"disabled").addClass('btn-disable').val('重发验证码(' + parseInt({{ Config::get('app.sms_limit_time')}}) + ')');
                                    var clickTime = new Date().getTime();
                                    // 记录用户点击发送验证码按钮的时间，防止页面刷新后按钮可以点击
                                    localStorage.setItem('clickTime', clickTime.toString());
                                    sms_button($('#sms_btn'), parseInt({{ Config::get('app.sms_limit_time')}}));

                                    // ajax发送短信验证码
                                    $.ajax({
                                        method: 'POST',
                                        url: '/sms/validate',
                                        dataType: 'json',
                                        data: {
                                            '_token': '{{csrf_token()}}',
                                            'geetest_key': data.geetest_key,
                                        },
                                        success: function (data) {
                                            $('#sms_key').val(data.sms_key);
                                        },
                                        error: function(xhr){
                                            showMsg($('form'), getObjFirst(xhr.responseJSON.errors)[0]);
                                        }
                                    });
                                },
                                error: function(xhr){
                                    showMsg($('form'), getObjFirst(xhr.responseJSON.errors)[0]);
                                    // 待优化，重写极验证；
                                }
                            });
                        } else {
                            showMsg($('form'), '验证码 未完成点击验证操作');
                        }
                    } else {
                        showMsg($('form'), '手机号 格式错误');
                    }
                } else {
                    showMsg($('form'), '手机号 不能为空');
                }
            });
        });

        $('.btn-reg').click(function (e) {
            var username = $('input[name="username"]').val();
            var password = $('input[name="password"]').val();
            var confirm_pw = $('input[name="password_confirmation"]').val();
            var mobile = $('input[name="mobile"]').val();
            var sms_code = $('input[name="sms_code"]').val();
            var agree_check = $('input[name="agree_check"]').prop('checked');

            if (!username) {
                showMsg($('form'), '账户名 不能为空');
                e.preventDefault();
                return;
            } else if (!password) {
                showMsg($('form'), '密码 不能为空');
                e.preventDefault();
                return;
            } else if (!confirm_pw || !confirm_pw == password) {
                showMsg($('form'), '两次密码不一致');
                e.preventDefault();
                return;
            } else if (!mobile) {
                showMsg($('form'), '手机号码 不能为空');
                e.preventDefault();
                return;
            } else if (!sms_code) {
                showMsg($('form'), '短信验证码 不能为空');
                e.preventDefault();
                return;
            } else if (!agree_check) {
                showMsg($('form'), '请阅读并同意平台相关协议');
                e.preventDefault();
                return;
            }
        });

    </script>
@endsection
