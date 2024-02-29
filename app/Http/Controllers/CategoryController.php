<?php

/**
 * @file CategoryController.php
 * @brief カテゴリーに関するコントローラー
 * 
 * @author Ayumu Ishikawa
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Category;

class CategoryController extends Controller
{
    /*
     * カテゴリーの一覧と関連する投稿を表示する
     *
     * @param \App\Models\Category $category 表示するカテゴリー
     * @return \Illuminate\Http\RedirectResponse ('categories.index')
     */
    public function index(Category $category)
    {
        // カテゴリーと関連する投稿をビューに渡す
        return view('categories.index')->with(['category' => $category,'posts' => $category->getByCategory()]);
    }
}
