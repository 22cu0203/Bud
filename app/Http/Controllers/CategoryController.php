<?php

/*
    カテゴリーに関するController
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Category;

class CategoryController extends Controller
{
    // 任意のカテゴリーとその投稿をViewにを足すための処理
    public function index(Category $category)
    {
        return view('categories.index')->with(['category' => $category,'posts' => $category->getByCategory()]);
    }
}
