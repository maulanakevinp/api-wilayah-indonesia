<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravolt\Indonesia\IndonesiaService;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
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
