<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\account;
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
Route::post('login', 'Api\MyController@login');
Route::apiResource('student', 'Api\MyController');
Route::apiResource('listclass', 'Api\MyController');
Route::apiResource('listsv', 'Api\StudentController');
Route::apiResource('listsvcn', 'Api\CnController');
Route::apiResource('addstudent','Api\CnController');
Route::apiResource('update','Api\CnController');
Route::apiResource('delete','Api\CnController');
Route::post('diemdanh', 'Api\StudentController@diemdanh');
Route::post('ngayvang', 'Api\StudentController@ngayvang');
Route::apiResource('lhp','Api\LophocphanController');
Route::post('diem', 'Api\MyController@diem');
Route::post('capnhat', 'Api\LophocphanController@capnhat');
Route::post('xoa', 'Api\LophocphanController@xoa');
Route::apiResource('gv','Api\GvController');