<?php

/**
 * @file Category.php
 * @brief カテゴリーに関する処理を担当するモデル
 * 
 * @author Ayumu Ishikawa
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    /**
     * カテゴリーに関連する投稿を取得
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasmany(Post::class);
    }
    
    /**
     * 指定された件数でページネーションを行い、カテゴリーに関連する投稿を取得
     *
     * @param int $limit_count ページごとの投稿数
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getByCategory(int $limit_count = 30)
    {
        return $this->posts()->with('category')->orderBy('updated_at' , 'DESC')->paginate($limit_count);
    }
    
}
