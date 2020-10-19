@extends('layouts.layout')

@section('content')

<h1>{{ $post->title }}</h1>

<div id="template">
    <div class="row">
        <div id="user-basic-info" class="col-12">
            <div id="image-wrap">
                <img src="/storage/{{ $postUser->image_file_name }}" alt="prof-img" id="prof-img">
            </div>
            <div class="col-12" id="user">
                <p class="name">
                    {{ \App\User::find($postUser->id)->name }}
                </p>

                @foreach(\App\User::AREA as $key => $val)
                @if(\App\User::find($postUser->id)->residence == $key)
                <p class="residence">
                    {{$val['label']}}
                </p>
                @endif
                @endforeach

                @foreach(\App\User::GENDER as $key => $val)
                @if(\App\User::find($postUser->id)->gender == $key)
                <p class="gender-age">
                    {{ $val['label'] }} / {{ \App\User::age($postUser->id) }}
                </p>
                @endif
                @endforeach
            </div>
        </div>

        <div class="contents col-12">

            @if($post->post_type == 1)
            <h2>募集しているパート</h2>
            @elseif($post->post_type == 2)
            <h2>加入できるパート</h2>
            @endif

            <div class="parts">
                @foreach(\App\User::PART as $key => $val)
                @if($post->part_1 == $key)
                <p class="part">・{{ $val['label'] }}</p>
                @elseif($post->part_2 == $key)
                <p class="part">・{{ $val['label'] }}</p>
                @elseif($post->part_3 == $key)
                <p class="part">・{{ $val['label'] }}</p>
                @elseif($post->part_4 == $key)
                <p class="part">・{{ $val['label'] }}</p>
                @elseif($post->part_5 == $key)
                <p class="part">・{{ $val['label'] }}</p>
                @elseif($post->part_6 == $key)
                <p class="part">・{{ $val['label'] }}</p>
                @elseif($post->part_7 == $key)
                <p class="part">・{{ $val['label'] }}</p>
                @elseif($post->part_8 == $key)
                <p class="part">・{{ $val['label'] }}</p>
                @endif
                @endforeach
            </div>

        </div>

        <div class="contents col-12">
            <h2>活動地域</h2>

            <div class="areas">
                @foreach(\App\User::AREA as $key => $val)
                @if($post->area_1 == $key)
                <p class="area">・{{ $val['label'] }}</p>
                @elseif($post->area_2 == $key)
                <p class="area">・{{ $val['label'] }}</p>
                @elseif($post->area_3 == $key)
                <p class="area">・{{ $val['label'] }}</p>
                @elseif($post->area_4 == $key)
                <p class="area">・{{ $val['label'] }}</p>
                @elseif($post->area_5 == $key)
                <p class="area">・{{ $val['label'] }}</p>
                @endif
                @endforeach
            </div>
        </div>

        <div class="contents col-12">
            <h2>掲載文</h2>

            <div class="body">
                <pre><p>{{ $post->body }}</p></pre>
            </div>
        </div>

        <div class="btn-box">
            <a href="{{ route('users.show', ['user' => $post->user_id]) }}">
                <button class="btn">投稿者のプロフィール</button>
            </a>
        </div>

        @if(Auth::check())

        @if(!(Auth::id() == $post->user_id))

        <div class="btn-box">
            @if(Auth::user()->is_bookmarks($post->id))
            <form action="{{ route('take_bookmark', ['post' => $post->id]) }}" method="post">
                @csrf
                <button class="btn" type="submit">ブックマークから削除</button>
            </form>
            @else
            <form action="{{ route('add_bookmark', ['post' => $post->id]) }}" method="post">
                @csrf
                <button class="btn" type="submit">ブックマークに追加</button>
            </form>
            @endif
        </div>

        <div class="btn-box">
            <form action="{{ route('rooms.store') }}" method="post">
                @csrf
                <input type="text" name="id" value="{{ $post->user_id }}" style="display:none">
                <button class="btn" type="submit">メッセージを送る</button>
            </form>
        </div>

        @else
        <div class="btn-box">
            <a href="{{ route('posts.edit', ['post' => $post->id]) }}">
                <button class="btn">編集する</button>
            </a>
        </div>
        <div class="btn-box">
            <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="post">
                @csrf
                @method('delete')
                <button class="btn">削除する</button>
            </form>
        </div>
        @endif

        @endif
    </div>
</div>

@endsection