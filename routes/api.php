<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api'
], function($api) {

    $api->group([
        'middleware' => 'api.throttle',
        'limit' => 10,
        'expires' => 1,
    ], function ($api) {
        // 短信验证码
        $api->post('smsCodes', 'SmsCodesController@store')
            ->name('api.smsCodes.store');
    });
});
