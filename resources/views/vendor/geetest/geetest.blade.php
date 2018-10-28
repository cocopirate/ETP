@define use Illuminate\Support\Facades\Config
<div id="{{ $captchaid }}">
    <div id="text_{{ $captchaid }}" class="wait-text">
        行为验证™ 安全组件加载中
    </div>
    <div id="wait_{{ $captchaid }}" class="wait-dot">
        <div class="loading f-cb">
            <div class="loading-dot"></div>
            <div class="loading-dot"></div>
            <div class="loading-dot"></div>
            <div class="loading-dot"></div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="https://static.geetest.com/static/tools/gt.js"></script>
<script>
    var geetest = function(url) {
        var handlerEmbed = function(captchaObj) {
            $('#{{ $captchaid }}').closest('form').submit(function(e) {
                var validate = captchaObj.getValidate();
                if (!validate) {
                    // 前端校验是否已验证
                    // $(this).parent().prepend(alert);
                    // e.preventDefault();
                }
            });
            captchaObj.appendTo("#{{ $captchaid }}");
            captchaObj.onReady(function() {
                $('#wait_{{ $captchaid }}').hide();
            });
            if ('{{ $product }}' == 'popup') {
                captchaObj.bindOn($('#{{ $captchaid }}').closest('form').find(':submit'));
                captchaObj.appendTo("#{{ $captchaid }}");
            }
        };
        $.ajax({
            url: url + "?t=" + (new Date()).getTime(),
            type: "get",
            dataType: "json",
            success: function(data) {
                $('#text_{{ $captchaid }}').hide();
                $('#wait_{{ $captchaid }}').show();
                initGeetest({
                    gt: data.gt,
                    challenge: data.challenge,
                    product: "{{ $product?$product:Config::get('geetest.product', 'float') }}",
                    offline: !data.success,
                    new_captcha: data.new_captcha,
                    lang: '{{ Config::get('geetest.lang', 'zh-cn') }}',
                    http: '{{ Config::get('geetest.protocol', 'http') }}' + '://',
                    width: '{{ Config::get('geetest.width', '300px') }}'
                }, handlerEmbed);
            }
        });
    };
    (function() {
        geetest('{{ $url?$url:Config::get('geetest.url', 'geetest') }}');
    })();
</script>
<style>
    .wait-text {
        height: 42px;
        width: 290px;
        text-align: center;
        border-radius: 2px;
        background-image: linear-gradient(180deg, #ffffff 0%,#f3f3f3 100%);
        color: #666;
        border: 1px solid #ccc;
        font-size: 14px;
        letter-spacing: 0.1px;
        line-height: 42px;
    }
    .wait-dot {
        display: none;
        height: 42px;
        width: 290px;
        text-align: center;
        border-radius: 2px;
        background-image: linear-gradient(180deg, #ffffff 0%,#f3f3f3 100%);
        color: #666;
        border: 1px solid #ccc;
    }

    .loading {
        margin: auto;
        width: 70px;
        height: 20px;
    }

    .loading-dot {
        float: left;
        width: 8px;
        height: 8px;
        margin: 18px 4px;
        background: #ccc;

        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;

        opacity: 0;

        -webkit-box-shadow: 0 0 2px black;
        -moz-box-shadow: 0 0 2px black;
        -ms-box-shadow: 0 0 2px black;
        -o-box-shadow: 0 0 2px black;
        box-shadow: 0 0 2px black;

        -webkit-animation: loadingFade 1s infinite;
        -moz-animation: loadingFade 1s infinite;
        animation: loadingFade 1s infinite;
    }

    .loading-dot:nth-child(1) {
        -webkit-animation-delay: 0s;
        -moz-animation-delay: 0s;
        animation-delay: 0s;
    }

    .loading-dot:nth-child(2) {
        -webkit-animation-delay: 0.1s;
        -moz-animation-delay: 0.1s;
        animation-delay: 0.1s;
    }

    .loading-dot:nth-child(3) {
        -webkit-animation-delay: 0.2s;
        -moz-animation-delay: 0.2s;
        animation-delay: 0.2s;
    }

    .loading-dot:nth-child(4) {
        -webkit-animation-delay: 0.3s;
        -moz-animation-delay: 0.3s;
        animation-delay: 0.3s;
    }

    @-webkit-keyframes loadingFade {
        0% { opacity: 0; }
        50% { opacity: 0.8; }
        100% { opacity: 0; }
    }

    @-moz-keyframes loadingFade {
        0% { opacity: 0; }
        50% { opacity: 0.8; }
        100% { opacity: 0; }
    }

    @keyframes loadingFade {
        0% { opacity: 0; }
        50% { opacity: 0.8; }
        100% { opacity: 0; }
    }
</style>
