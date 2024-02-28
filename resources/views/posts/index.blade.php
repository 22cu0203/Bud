<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Bud</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <x-app-layout>
        <body>
            <x-primary-button>
                <a href='/posts/create'>{{ __('投稿作成') }}</a>
            </x-primary-button>
                <div class='posts'>
                    <div class="flex flex-wrap grid grid-cols-2 gap-10 ">
                    @foreach ($posts as $post)
                            <div class="shadow-lg rounded border bg-slate-50 hover:bg-slate-300 p-3 flex justify-center items-center">
                                <div class='post'>
                                    <h2 class='title text-2xl font-bold'>
                                        <a href="/posts/{{$post->id}}">{{ $post->title }}</a>
                                    </h2> 
                                    <div class="text-sky-500 dark:text-sky-400">
                                    <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                                    </div>
                                    <p class='body'>{{ $post->body }}</p>
                                    <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <x-primary-button onclick="deletePost({{ $post->id }})">削除</x-primary-button>
                                    </form>
                                </div>
                            </div>
                    @endforeach
                    </div>
                </div>
            <div class='paginate flex justify-center'>
                {{ $posts->links() }}
            </div>
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