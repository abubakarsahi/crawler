<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShortLinkController;
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

Route::get(
    '/crawl',
    [ProductController::class, 'store']
);

Route::get(
    '/products/list',
    [ProductController::class, 'index']
);
Route::post(
    '/make-url-short',
    [ShortLinkController::class, 'store']
);
Route::get(
    '/short-url/list',
    [ShortLinkController::class, 'index']
);

Route::get(
    '/go-to-url/{code}',
    [ShortLinkController::class, 'index']
);
Route::get('go-to-url/{code}/', 'App\Http\Controllers\ShortLinkController@show');
