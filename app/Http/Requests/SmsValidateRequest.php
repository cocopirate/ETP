<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SmsValidateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'geetest_key' => 'required|string',
        ];
    }

    public function attributes()
    {
        return [
            'geetest_key' => '极验证码',
        ];
    }
}
