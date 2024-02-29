<!DOCTYPE HTML>


<!--投稿詳細画面のView-->


<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Posts</title>
        <!-- フォント -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!--TailWind使用-->
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <x-app-layout>
        <body>
            
            <!--投稿の表示に関するView-->
            <div class="shadow-lg bg-slate-50 rounded-xl border p-8">
            
                <!--タイトルに関するView-->
                <h2 class="title text-2xl font-bold">
                    {{ $post->title }}
                </h2>
                
                <!--投稿の本文に関するView-->
                <div class="content">
                    <div class="content__post">
                        <h3>本文</h3>
                        <p>{{ $post->body }}</p>    
                    </div>
                </div>
                
                <!--カテゴリーに関するView-->
                <div class="text-sky-500 dark:text-sky-400">
                    <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                </div>
                
                <!--並列に配置-->
                <div class="flex">
                    <!--編集ボタンに関するView-->
                    <x-primary-button class="edit mr-2">
                        <a href="/posts/{{ $post->id }}/edit">{{ __('編集') }}</a>
                    </x-primary-button>
                    
                    <!--戻るボタンに関するView-->
                    <x-secondary-button class="footer" >
                        <a href="/">{{ __('戻る') }}</a>
                    </x-secondary-button>
                </div>
            </div>
        </body>
    </x-app-layout>
</html>