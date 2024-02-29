<?php

/**
 * @file User.php
 * @brief ユーザーに関する値受け渡しの制限ｗｐ担当するモデル
 */

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * 可変属性
     *
     * @var array<int, string>
     */    
     protected $fillable = [
        'name',         // ユーザーネーム
        'email',        // メールアドレス
        'password',     // パスワード
    ];

    /**
     * シリアライズ時に非表示とする属性
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',         // パスワード
        'remember_token',   // ログイン維持トークン
    ];

    /**
     * キャストする属性
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',      // メールアドレス確認日時
    ];
}
