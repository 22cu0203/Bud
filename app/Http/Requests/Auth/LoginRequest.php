<?php

/**
 * @file LoginRequest.php
 * @brief ログインリクエストに関する処理
 */

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /*
     * リクエストの認可を行う
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // 常に true を返し、すべてのリクエストを認可する
        return true;
    }

    /**
     * バリデーションルールを定義する
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /*
     * ユーザーの認証を行う
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        // レート制限されていないことを確認する
        $this->ensureIsNotRateLimited();

        // ユーザーの認証を試みる
        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            // 認証に失敗した場合、レートリミッターを更新し、例外をスローする
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }
        
        // 認証に成功した場合、レートリミッターをクリアする
        RateLimiter::clear($this->throttleKey());
    }

    /*
     * レート制限されていないことを確認する
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        // レート制限されていない場合はメソッドを終了する
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        // Lockout イベントを発生させる
        event(new Lockout($this));

        // リトライまでの時間を取得する
        $seconds = RateLimiter::availableIn($this->throttleKey());
        
        // レート制限エラーメッセージと共に ValidationException をスローする
        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /*
     * レート制限のキーを生成する
     *
     * @return string
     */
    public function throttleKey(): string
    {
        // メールアドレスとIPアドレスを組み合わせてキーを生成する
        return Str::transliterate(Str::lower($this->input('email')).'|'.$this->ip());
    }
}
