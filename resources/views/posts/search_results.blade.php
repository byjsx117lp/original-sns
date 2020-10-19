@extends('layouts.layout')

@section('content')

<h1>検索結果</h1>

@if($results)

    @foreach($results as $result)

    <div class="post">
        <a href="{{ route('posts.show', ['post' => $result->id]) }}">
            <div class="update-time">投稿日時：{{ $result->updated_at->format('Y年m月d日 H時i分') }}</div>
            <div class="post-top">
                <h2 class="title">
                    {{ $result->title }}
                </h2>
                @if($result->post_type == 1)
                <p class="post-type recruitment">募集</p>
                @else
                <p class="post-type join">加入</p>
                @endif
            </div>
            <div class="post-middle">
                <p class="body">{{ $result->body }}</p>
            </div>
            <div class="post-bottom">
                <p class="user-info">{{ \App\User::find($result->user_id)->name }}
                    @foreach(\App\User::AREA as $key => $val)
                        @if(\App\User::find($result->user_id)->residence == $key)
                        ({{$val['label']}})
                        @endif
                    @endforeach
                </p>
                @foreach(\App\User::GENDER as $key => $val)
                    @if(\App\User::find($result->user_id)->gender == $key)
                    <p class="user-info">{{ $val['label'] }}</p>
                    @endif
                @endforeach
                <p class="user-info">年齢</p>
                @foreach(\App\Post::STANCE as $key => $val)
                    @if($result->stance == $key)
                    <p class="user-info">活動方針：{{ $val['label'] }}</p>
                    @endif
                @endforeach
            </div>
        </a>
    </div>

    @endforeach

@else
    <p>指定された条件の投稿はありませんでした</p>
@endif

@endsection