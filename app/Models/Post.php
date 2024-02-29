<?php

/**
 * @file Post.php
 * @brief 投稿に関する処理
 * 
 * @author Ayumu Ishikawa
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'title',            // タイトル
        'body',             // 企画内容
        'category_id'       // カテゴリーID
        ];
    
    /**
     * 指定された件数で最新の投稿を取得
     *
     * @param int $limit_count 取得する件数
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByLimit(int $limit_count = 10)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this->orderBy('updated_at', 'DESC')->limit($limit_count)->get();
    }
    
    /**
     * 指定された件数でページネーションを行い、最新の投稿を取得
     *
     * @param int $limit_count ページごとの投稿数
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPaginateByLimit(int $limit_count = 30)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this::with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
        
    }
    
    /**
     * この投稿が所属するカテゴリーを取得
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
