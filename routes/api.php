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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

header("Access-Control-Allow-Origin: https://residentialproperti.com");
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Methods: POST');

Route::post('contact-form', function (Request $request) {
    try {
        $data = [
            'referer' => @$request->referer,
            'phone_number' => @$request->phone_number,
            'ip_address' => @$request->ip(),
            'agent' => @$request->server('HTTP_USER_AGENT'),
        ];
        Illuminate\Support\Facades\DB::connection('cc')->table('someah_contact_form')->insert($data);
        return response()->json([
            'msg' => 'Data berhasil disimpan.',
        ]);
    } catch (Exception $e) {
        return response()->json([
            'msg' => 'Data gagal disimpan, silakan coba kembali.',
            'error' => $e->getMessage()
        ], 500);
    }
});