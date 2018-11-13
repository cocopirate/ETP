<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Overtrue\EasySms\EasySms;
use App\Http\Requests\Api\SmsCodeRequest;
use Illuminate\Support\Facades\Cache;
use Overtrue\EasySms\Exceptions\NoGatewayAvailableException;

class SmsCodesController extends Controller
{
    public function store( SmsCodeRequest $request, EasySms $easySms)
    {
        $mobile = $request->mobile;

        if (!app()->environment('production')) {
            $code = '1234';
        } else {
            // 生成4位随机数，左侧补0
            $code = str_pad(random_int(1, 9999), 4, 0, STR_PAD_LEFT);

            try {
                $easySms->send($mobile,[
                    'template' => 'SMS_132385787',
                    'data' => [
                        'code' => $code,
                    ],
                ]);
            } catch (NoGatewayAvailableException $exception) {
                $message = $exception->getException('aliyun')->getMessage();
                return $this->response->errorInternal($message ?? '短信发送异常');
            }
        }

        $key = 'smsCode_'.str_random(15);
        // 缓存验证码 10分钟过期。
        $expiredAt = now()->addMinute(10);
        Cache::put($key, ['mobile' => $mobile, 'code' => $code], $expiredAt);

        return $this->response->array([
            'sms_key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
        ])->setStatusCode(201);
    }
}
