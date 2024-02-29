<?php

/**
 * @file ProfileController.php
 * @brief プロフィールに関するコントローラー
 */

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /*
     * プロフィール編集画面を表示する
     *
     * @param \Illuminate\Http\Request $request 編集リクエスト
     * @return \Illuminate\Http\Response ('profile.edit', ['user' => $request->user(),]) view
     */    
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /*
     * プロフィールを更新する
     *
     * @param \App\Http\Requests\ProfileUpdateRequest $request プロフィール更新リクエスト
     * @return \Illuminate\Http\RedirectResponse
     */    
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // リクエストの検証済みデータでユーザーモデルを更新する
        $request->user()->fill($request->validated());
        
        // メールアドレスが変更された場合、メールアドレスの確認をリセットする
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        
        // ユーザーモデルを保存する
        $request->user()->save();
        
        // プロフィール編集ページにリダイレクトし、成功メッセージを表示する
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /*
     * ユーザーアカウントを削除する
     *
     * @param \Illuminate\Http\Request $request リクエスト
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        // リクエストの検証を行う
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        // リクエストからユーザーを取得する
        $user = $request->user();

        // ユーザーをログアウトする
        Auth::logout();
        
        // ユーザーを削除する
        $user->delete();
        
        // セッションを無効にし、新しいトークンを生成する
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // ホームページにリダイレクトする
        return Redirect::to('/');
    }
}
