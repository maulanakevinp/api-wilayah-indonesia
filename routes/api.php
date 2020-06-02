<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravolt\Indonesia\IndonesiaService;
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

Route::group(['prefix' => 'wilayah'], function () {
    Route::get('/provinsi', function(){
        $indonesia = new IndonesiaService;
        return $indonesia->allProvinces();
    });

    Route::get('/provinsi/{provinsi_id}', function ($request) {
        $indonesia = new IndonesiaService;
        return $indonesia->findProvince($request, ['cities']);
    });

    Route::get('/kabupaten/{kabupaten_id}', function ($request) {
        $indonesia = new IndonesiaService;
        return $indonesia->findCity($request, ['districts']);
    });

    Route::get('/kecamatan/{kecamatan_id}', function ($request) {
        $indonesia = new IndonesiaService;
        return $indonesia->findDistrict($request, ['villages']);
    });

    Route::get('/desa/{desa_id}', function ($request) {
        $indonesia = new IndonesiaService;
        return $indonesia->findVillage($request);
    });
});
