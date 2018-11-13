<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\GeetestValidateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use phpDocumentor\Reflection\Type;

class GeetestValidateController extends Controller
{
    public function store(GeetestValidateRequest $request)
    {
        if ($request->type == 'register') {
            $this->validate($request, [
                'mobile' => 'unique:users'
            ]);
        }

        $key = 'geetest-'.$request->type.'-'.str_random(15);
        $mobile = $request->mobile;
        $expiredAt = now()->addMinutes(2);
        Cache::put($key, ['mobile' => $mobile], $expiredAt);
        return response()->json([
            'geetest_key' => $key,
            'expired_at' => $expiredAt->toDateTimeString()
        ]);
    }
}
