<?php

/**
 * @file ProfileUpdateRequest.php
 * @brief プロフィール更新リクエストに関する処理
 */

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * フォームリクエストのバリデーションルールを定義する
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],    // 名前は文字列で、最大255文字まで
            'email' => [
                'email',        // メールアドレスの形式であることを確認
                'max:255',      // 最大255文字まで
                
                Rule::unique(User::class)->ignore($this->user()->id)        // ユーザーのIDを除外して、一意のメールアドレスであることを確認
            ],
        ];
    }
}
