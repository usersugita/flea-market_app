<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarketController;
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


Route::middleware('auth')->group(function () {
    Route::get('/', [MarketController::class, 'index']);
    Route::post('/', [MarketController::class, 'profile']);
    Route::get('/item/{id}', [MarketController::class, 'item']);
    Route::post('/item/{id}', [MarketController::class, 'itemstore']);
    Route::post('/item/{id}/like', [MarketController::class, 'itemstore'])->name('item.like');
    Route::post('/item/{id}/comment', [MarketController::class, 'comment'])->name('item.comment');
    Route::get('/profile', function () {
        return view('profile'); // 新規登録後のページ
    })->name('profile');

    Route::get('/sell', [MarketController::class, 'sell']);
    Route::get('/mypage', [MarketController::class, 'mypage']);
});
