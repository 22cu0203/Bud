<!DOCTYPE HTML>


<!--カテゴリー別に投稿を一覧表示する画面のView-->


<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Bud/投稿一覧/{{ $category->name }}</title>
        <!-- フォント -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!--TailWind使用-->
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <x-app-layout>
        
        <!--ヘッダー-->
        <x-slot name="header">
            <!--表示しているカテゴリー-->
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $category->name }}
            </h2>
        </x-slot>
        
        <body>
            
            <!--投稿作成ボタンに関するView-->
            <x-primary-button>
                <a href='/posts/create'>{{ __('投稿作成') }}</a>
            </x-primary-button>
            
            <!--投稿全体に関するView-->
            <div class='posts'>
                <div class="flex flex-wrap grid md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach ($posts as $post)
                
                    <!--個々の投稿に関するView-->
                    <div class="shadow-lg rounded border bg-slate-50 hover:bg-slate-300 py-5 flex justify-center items-center h-80">
                        <div class='post'>
                            
                            <!--タイトルに関するView-->
                            <h2 class='title text-2xl font-bold'>
                                <a href="/posts/{{$post->id}}">{{ $post->title }}</a>
                            </h2> 
                            
                            <!--カテゴリーに関するView-->
                            <div class="text-sky-500 dark:text-sky-400">
                                <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                            </div>
                            
                            <!--企画内容に関するView-->
                            <p class='body'>{{ $post->body }}</p>
                            
                            <!--削除ボタンに関するView-->
                            <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                                @csrf
                                @method('DELETE')
                                <x-primary-button onclick="deletePost({{ $post->id }})">削除</x-primary-button>
                            </form>
                        </div>
                    </div>    
                @endforeach
            </div>
            
            <!--ペジネーションに関するView-->
            <div class='paginate flex justify-center'>
                {{ $posts->links() }}
            </div>
            
             <!--削除ボタンが押された際の処理-->
            <script>
                function deletePost(id) {
                    'use strict'
            
                    if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                        document.getElementById(`form_${id}`).submit();
                    }
                }
            </script>
        </body>
    </x-app-layout>
</html>