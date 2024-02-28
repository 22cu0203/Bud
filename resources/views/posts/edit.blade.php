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
            <div class="shadow-lg bg-slate-50 rounded-xl border p-8">
                <div class="content">
                    <form action="/posts/{{ $post->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!--タイトルに関するView-->
                        <div class='content__title'>
                            <x-input-label :value="__('タイトル')" />
                            <x-text-input  name="post[title]" type="text" class="mt-1" value="{{ $post->title }}" />
                            <x-input-error class="mt-2" :messages="$errors->first('post.title')" />
                        </div>
                        
                        <!--本文に関するView-->
                        <div class='content__body'>
                            <x-input-label :value="__('本文')" />
                            <textarea name="post[body]" class="rounded-md" >{{ $post->body }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->first('post.body')" />
    
                        </div>
                        
                        <!--カテゴリーに関するView-->
                        <div class="category">
                            <x-input-label :value="__('カテゴリー')" />
                            <select name="post[category_id]" class="rounded-md">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!--保存ボタンに関するView-->
                        <x-primary-button>{{ __('保存') }}</x-primary-button>
                    </form>
                </div>
            </div>
        </body>
    </x-app-layout>
</html>