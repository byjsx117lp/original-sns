@extends('layouts.layout')

@section('content')

<h1>記事検索</h1>

@if($errors->any())
<div class="alert alert-danger">
    @foreach($errors->all() as $message)
    <p class="area">{{ $message }}</p>
    @endforeach
</div>
@endif

<form action="{{ route('posts.search') }}" method="post" class="form">
    @csrf
    
    <div class="form-parts">
        <label for="post_type">記事タイプ</label><br>
        <select name="post_type" id="post_type">
        @foreach(\App\Post::POST_TYPE as $key => $val)
            <option value="{{ $key }}">{{ $val['label'] }}</option>
        @endforeach
        </select>
    </div>

    <div class="form-parts">
        <label for="part">パート</label><br>
        @foreach(\App\User::PART as $key => $val)
        @if(!($key == 0))
            <input type="checkbox" name="parts[]" id="part" value="{{ $key }}">{{ $val['label'] }}
        @endif
        @endforeach
    </div>

    <div class="form-parts">
        <label for="stance">活動スタンス<span class="required"></span></label><br>
        <select name="stance" id="stance">
            @foreach(\App\Post::STANCE as $key => $val)
            <option value="{{ $key }}">{{ $val['label'] }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-parts">
        <label for="">活動地域<span class="required"> *5ヵ所まで選択できます</span></label>
        <div class="area">
            <p>北海道地方</p>
            @foreach(\App\User::AREA as $key => $val)
                @if($val['area'] == '北海道地方')
                <input type="checkbox" name="areas[]" id="" value="{{ $key }}">{{ $val['label'] }}
                @endif
            @endforeach
        </div>

        <div class="area">
            <p class="area">東北地方</p>
            @foreach(\App\User::AREA as $key => $val)
                @if($val['area'] == '東北地方')
                <input type="checkbox" name="areas[]" id="" value="{{ $key }}">{{ $val['label'] }}
                @endif
            @endforeach
        </div>

        <div class="area">
            <p class="area">関東地方</p>
            @foreach(\App\User::AREA as $key => $val)
                @if($val['area'] == '関東地方')
                <input type="checkbox" name="areas[]" id="" value="{{ $key }}">{{ $val['label'] }}
                @endif
            @endforeach
        </div>

        <div class="area">
            <p class="area">中部地方</p>
            @foreach(\App\User::AREA as $key => $val)
                @if($val['area'] == '中部地方')
                <input type="checkbox" name="areas[]" id="" value="{{ $key }}">{{ $val['label'] }}
                @endif
            @endforeach
        </div>

        <div class="area">
            <p class="area">関西地方</p>
            @foreach(\App\User::AREA as $key => $val)
                @if($val['area'] == '関西地方')
                <input type="checkbox" name="areas[]" id="" value="{{ $key }}">{{ $val['label'] }}
                @endif
            @endforeach
        </div>

        <div class="area">
            <p class="area">中国地方</p>
            @foreach(\App\User::AREA as $key => $val)
                @if($val['area'] == '中国地方')
                <input type="checkbox" name="areas[]" id="" value="{{ $key }}">{{ $val['label'] }}
                @endif
            @endforeach
        </div>

        <div class="area">
            <p class="area">四国地方</p>
            @foreach(\App\User::AREA as $key => $val)
                @if($val['area'] == '四国地方')
                <input type="checkbox" name="areas[]" id="" value="{{ $key }}">{{ $val['label'] }}
                @endif
            @endforeach
        </div>

        <div class="area">
            <p class="area">九州地方</p>
            @foreach(\App\User::AREA as $key => $val)
                @if($val['area'] == '九州地方')
                <input type="checkbox" name="areas[]" id="" value="{{ $key }}">{{ $val['label'] }}
                @endif
            @endforeach
        </div>

        <div class="area">
            <p class="area">沖縄地方</p>
            @foreach(\App\User::AREA as $key => $val)
                @if($val['area'] == '沖縄地方')
                <input type="checkbox" name="areas[]" id="" value="{{ $key }}">{{ $val['label'] }}
                @endif
            @endforeach
        </div>

        <div class="area">
            @foreach(\App\User::AREA as $key => $val)
                @if($val['area'] == 'その他')
                <input type="checkbox" name="areas[]" id="" value="{{ $key }}">{{ $val['label'] }}
                @endif
            @endforeach
        </div>
    </div>

    <div class="form-parts">
        <label for="order">表示順</label><br>
        <select name="order" id="order">
            @foreach(\App\Post::ORDER as $key => $val)
            <option value="{{ $key }}">{{ $val['label'] }}</option>
            @endforeach
        </select>
    </div>

    <div class="btn-box">
        <button class="btn" type="submit">検索する</button>
    </div>

</form>


<h2>新着投稿</h2>
@foreach($posts as $post)

<div class="post">
    <a href="{{ route('posts.show', ['post' => $post->id]) }}">
        <div class="update-time">投稿日時：{{ $post->updated_at->format('Y年m月d日 H時i分') }}</div>
        <div class="post-top">
            <h2 class="title">
                {{ $post->title }}
            </h2>
            @if($post->post_type == 1)
            <p class="post-type recruitment">募集</p>
            @else
            <p class="post-type join">加入</p>
            @endif
        </div>
        <div class="post-middle">
            <p class="body">{{ $post->body }}</p>
        </div>
        <div class="post-bottom">
            <p class="user-info">{{ \App\User::find($post->user_id)->name }}
                @foreach(\App\User::AREA as $key => $val)
                    @if(\App\User::find($post->user_id)->residence == $key)
                    ({{$val['label']}})
                    @endif
                @endforeach
            </p>
            @foreach(\App\User::GENDER as $key => $val)
                @if(\App\User::find($post->user_id)->gender == $key)
                <p class="user-info">{{ $val['label'] }}</p>
                @endif
            @endforeach
            <p class="user-info">年齢</p>
            @foreach(\App\Post::STANCE as $key => $val)
                @if($post->stance == $key)
                <p class="user-info">活動方針：{{ $val['label'] }}</p>
                @endif
            @endforeach
        </div>
    </a>
</div>

@endforeach

<div>{{ $posts->links() }}</div>

@endsection
