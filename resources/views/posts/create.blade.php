<!DOCTYPE HTML>


<!--投稿作成のView-->


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
                <form action="/posts" method="POST">
                    @csrf
                    
                    <!--タイトルに関するView-->
                    <div class="title">
                    
                        <x-input-label :value="__('タイトル')" />
                        <x-text-input  name="post[title]" type="text" placeholder="タイトル" class="mt-1" value="{{ old('post.title') }}" />
                        <x-input-error class="mt-2" :messages="$errors->first('post.title')" />
    
                        {{--<input type="text" name="post[title]" placeholder="タイトル" value="{{ old('post.title') }}"/>
                        <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>--}}
                    </div>
                    
                    <!--本文に関するView-->
                    <div class="body">
                        
                        <x-input-label :value="__('本文')" />
                        <textarea name="post[body]" class="rounded-md" placeholder="今日も1日お疲れさまでした。">{{ old('post.body') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->first('post.body')" />
                        
                        {{--<h2>Body</h2>
                        <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>--}}
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
                
                    <div class="flex">
                    <x-primary-button class="mr-2">{{ __('保存') }}</x-primary-button>
                    <!--<input type="submit" value="保存"/>-->
                    
                    <!--戻るボタンに関するView-->
                    <x-secondary-button class="back" >
                        <a href="/">{{ __('戻る') }}</a>
                    </x-secondary-button>
                    </div>
                </form>
                   
                <!--戻るボタンに関するView-->
                {{-- <x-secondary-button class="back" >
                    <a href="/">{{ __('戻る') }}</a>
                </x-secondary-button>
                --}}
            </div>
        </body>
    </x-app-layout>
</html>