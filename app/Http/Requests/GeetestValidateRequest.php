<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeetestValidateRequest extends FormRequest
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
            'mobile' => [
                'required',
                'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199|(147))\d{8}$/'
            ],
            'geetest_challenge' => [
                'required',
                'geetest'
            ],
            'type' => 'required'
        ];
    }

    /**
     * Get validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'geetest' => config('geetest.server_fail_alert')
        ];
    }
}
