<?php

/**
 * @file web.php
 * @brief ルーティングの設定
 * 
 * @author Ayumu Ishikawa
 */

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

//------------------------------------------------------------------------
// ダッシュボードに関するルーティング
//------------------------------------------------------------------------
Route::get('/dashboard', function () {
return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//------------------------------------------------------------------------
// 投稿に関するルーティング
//------------------------------------------------------------------------
Route::controller(PostController::class)->middleware(['auth'])->group(function(){
    Route::get('/', 'index')->name('index');                    // 一覧表示画面へ
    Route::post('/posts', 'store')->name('store');              // 保存時
    Route::get('/posts/create', 'create')->name('create');      // 投稿ボタン押下時 
    Route::get('/posts/{post}', 'show')->name('show');          // 投稿タイトル押下時
    Route::put('/posts/{post}', 'update')->name('update');      // 更新ボタン押下時
    Route::delete('/posts/{post}', 'delete')->name('delete');   // 削除ボタン押下時
    Route::get('/posts/{post}/edit', 'edit')->name('edit');     // 編集ボタン押下時
});

//------------------------------------------------------------------------
// 投稿のカテゴリーに関するルーティング
//------------------------------------------------------------------------
// 任意のカテゴリーの投稿一覧表示画面へ
Route::get('/categories/{category}', [CategoryController::class,'index'])->middleware("auth");

//------------------------------------------------------------------------
// プロフィールに関するルーティング
//------------------------------------------------------------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');               // プロフィール編集画面へ
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');         // 更新ボタン押下時
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');      // 削除ボタン押下時
});

require __DIR__.'/auth.php';