<?php

/**
 * @file PostController.php
 * @brief 投稿に関するコントローラー
 * 
 * @author Ayumu Ishikawa
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    /*
     * ペジネーション上限内のPost を一覧で表示する
     *
     * @params \App\Models\Post Post // 引数の$postはid=1のPostインスタンス
     * @return \Illuminate\Http\Response ('posts.index') view
     */
    public function index(Post $post)
    {
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit()]);
    }
     
    /*
     * 特定IDのPost を表示する
     *
     * @params \App\Models\Post Post // 引数の$postはid=1のPostインスタンス
     * @return \Illuminate\Http\Response ('posts/show') view
     */
    public function show(Post $post)
    {
        return view('posts/show')->with(['post' => $post]);
    }
    
    /*
     * Post を保存する
     *
     * @param \Illuminate\Http\Request $request     保存リクエスト
     * @param \App\Models\Post $post                保存する投稿
     * @return \Illuminate\Http\RedirectResponse ('/posts/' . $post->id)
     */   
    public function store(PostRequest $request, Post $post)
    {
        $input = $request['post'];
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }    
    
    /*
     * Post の編集画面を表示する
     *
     * @param \App\Models\Post $post            編集する投稿
     * @param \App\Models\Category $category    カテゴリー情報
     * @return \Illuminate\Http\Response ('posts.create') view
     */
    public function edit(Post $post,Category $category)
    {
        return view('posts.edit')->with(['post' => $post,'categories' => $category->get()]);
    }
    
    /*
     * Post の更新を処理する
     *
     * @param \App\Http\Requests\PostRequest $request   更新リクエスト
     * @param \App\Models\Post $post                    更新する投稿
     * @return \Illuminate\Http\RedirectResponse ('/posts/' . $post->id)
     */
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
    
        return redirect('/posts/' . $post->id);
    }
    
    /*
     * Post を削除する
     *
     * @param \App\Models\Post $post    削除する投稿
     * @return \Illuminate\Http\RedirectResponse ('/')
     */
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
    
    /*
     * 新しい投稿を作成するフォームを表示する
     *
     * @param \App\Models\Category $category カテゴリー情報
     * @return \Illuminate\Http\Response ('posts.create') view
     */
    public function create(Category $category)
    {
        return view('posts.create')->with(['categories' => $category->get()]);
    }   
}
