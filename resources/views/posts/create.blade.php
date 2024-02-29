<!DOCTYPE HTML>


<!--投稿作成画面のView-->


<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Bud/投稿作成</title>
        <!-- フォント -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!--TailWind使用-->
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <x-app-layout>
        <x-guest-layout>
            <body>
                <form action="/posts" method="POST">
                    @csrf
                    
                    <!--タイトルに関するView-->
                    <div class="title">
                    
                        <x-input-label :value="__('タイトル')" />
                        <x-text-input  name="post[title]" type="text" placeholder="タイトル" class="mt-1" value="{{ old('post.title') }}" />
                        <x-input-error class="mt-2" :messages="$errors->first('post.title')" />
    
                    </div>
                    
                    <!--本文に関するView-->
                    <div class="body">
                        
                        <x-input-label :value="__('企画内容')" />
                        <textarea name="post[body]" class="rounded-md" placeholder="企画内容">{{ old('post.body') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->first('post.body')" />
                        
                    </div>
                    
                    <!--カテゴリーに関するView-->
                    <div class="category"
                        
                        <x-input-label :value="__('カテゴリー')" />
                        <select name="post[category_id]" class="rounded-md">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                
                    <div class="flex">
                        
                        <!--保存ボタンに関するView-->
                        <x-primary-button class="mr-2">{{ __('保存') }}</x-primary-button>
    
                        <!--戻るボタンに関するView-->
                        <x-secondary-button class="back" >
                            <a href="/">{{ __('戻る') }}</a>
                        </x-secondary-button>
                        
                    </div>
                    
                </form>
            </body>
        </x-guest-layout>
    </x-app-layout>
</html>