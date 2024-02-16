<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    //インポートしたPostをインスタンス化して$postとして使用
    public function index(Post $post)
    {
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit()]);
    //getPaginateByLimit()はPost.phpで定義したメソッドです。    
    }
    /*
     * 特定IDのpostを表示する
     *
     * @params Object Post // 引数の$postはid=1のPostインスタンス
     * @return Reposnse post view
     */
     
    // public function create()
    // {
    //     return view('posts.create');
    // }
     
    public function show(Post $post)
    {
        return view('posts/show')->with(['post' => $post]);
        // dd($post);
    }
    
    public function store(PostRequest $request, Post $post)
    {
        $input = $request['post'];
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
        //dd($request->all());
    }    
    
    public function edit(Post $post)
    {
        return view('posts.edit')->with(['post' => $post]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
    
        return redirect('/posts/' . $post->id);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
    
    public function create(Category $category)
    {
        return view('posts.create')->with(['categories' => $category->get()]);
    }   
}
