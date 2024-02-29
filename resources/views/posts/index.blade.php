<!DOCTYPE HTML>


<!--メインで表示する投稿一覧画面のView-->


<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Bud</title>
        <!-- フォント -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!--TailWind使用-->
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <x-app-layout>
        <body>
            
            <!--投稿作成ボタンに関するView-->
            <x-primary-button>
                <a href='/posts/create'>{{ __('投稿作成') }}</a>
            </x-primary-button>
            
            <!--投稿全体に関するView-->
            <div class='posts'>
                <div class="flex flex-wrap grid grid-cols-2 gap-10 flex flex-col min-h-screen">
                @foreach ($posts as $post)
                
                    <!--個々の投稿に関するView-->
                    <div class="shadow-lg rounded border bg-slate-50 hover:bg-slate-300 p-3 flex justify-center items-center">
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
                                <x-primary-button onclick="deletePost({{ $post->id }})">{{ __('削除') }}</x-primary-button>
                            </form>
                        </div>
                    </div>
                @endforeach
                </div>
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