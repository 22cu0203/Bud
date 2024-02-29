<?php

/**
 * @file PostRequest.php
 * @brief 投稿リクエストに関する処理
 * 
 * @author Ayumu Ishikawa
 */


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    

    /*
     * フォームリクエストのバリデーションルールを定義する
     *
     * @return array
     */    
     public function rules()
    {
        return [
            'post.title' => 'required|string|max:40',       // タイトルは必須で、最大40文字まで
            'post.body' => 'required|string|max:4000',      // 本文は必須で、最大4000文字まで

        ];
    }
}
