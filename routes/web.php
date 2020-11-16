<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Raju\Streamer\Helpers\VideoStream;

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

Route::get('/get/image/', function () {
    return response()->file(storage_path('app\public\image\DSC09033.jpg'));
});

Route::get('/get/video/', function () {
    // return Storage::get('public\video\coffee-46989.mp4');
    // return Storage::url('public\video\sieu_nhan_gao.mp4');
    // return response()->file(storage_path('app\public\video\coffee-46989.mp4'));
    // return response()->file(storage_path('app\public\video\sieu_nhan_gao.mp4'));
    return view('iframe_flim')->with(
        'videoURL',
        Storage::path('public\video\sieu_nhan_gao.mp4')
    );
});

Route::get('/stream', function () {
    $stream = new VideoStream(Storage::path('public\video\sieu_nhan_gao.mp4'));
    return response()->stream(function() use ($stream) {
        $stream->start();
    });
});
