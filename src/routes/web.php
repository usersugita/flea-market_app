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

Route::get('/', [MarketController::class, 'index']);
Route::get('/search', [MarketController::class, 'search']);
Route::post('/', [MarketController::class, 'profile']);
Route::get('/item/{id}', [MarketController::class, 'item']);
Route::post('/item/{id}', [MarketController::class, 'itemstore']);
Route::post('/item/{id}/like', [MarketController::class, 'itemstore'])->name('item.like');
Route::post('/item/{id}/comment', [MarketController::class, 'comment'])->name('item.comment');

Route::middleware('auth')->group(function () {
    
    Route::get('/profile', function () {
        return view('profile'); // 新規登録後のページ
    })->name('profile');
    Route::post('/profile', [MarketController::class, 'uploadImage']);
    Route::get('/sell', [MarketController::class, 'sell']);
    Route::get('/mypage', [MarketController::class, 'mypage']);
    Route::post('/mypage/order', [MarketController::class, 'order']);
    Route::get('/purchase/{id}', [MarketController::class, 'purchase'])->name('purchase');
    // 住所変更ページの表示
    Route::get('/purchase/address/{id}', [MarketController::class, 'address']);
    // 住所変更処理
    Route::post('/purchase/address/{id}', [MarketController::class, 'addresschange']);
    Route::get('/mypage/profile', [MarketController::class, 'myprofile']);
    Route::post('/mypage/profile', [MarketController::class, 'updateImage']);
    Route::post('/mypage/profile/updateprofile', [MarketController::class, 'updateProfile']);
    Route::post('/sell', [MarketController::class, 'uploadImage']);
    Route::post('/listing', [MarketController::class, 'listing']);
   
   
});
