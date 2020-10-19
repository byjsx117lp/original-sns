@extends('layouts.layout')

@section('content')

<h1>記事編集</h1>

@if($errors->any())
<div class="alert alert-danger">
    @foreach($errors->all() as $message)
    <p>{{ $message }}</p>
    @endforeach
</div>
@endif

<form action="{{ route('posts.update', ['post' => $post->id]) }}" method="post" class="form">
    @csrf
    @method('put')
    <div class="form-parts">
        <label for="post_type">記事タイプ</label><br>
        <select name="post_type" id="post_type">
        @foreach(\App\Post::POST_TYPE as $key => $val)
            <option value="{{ $key }}" {{ $key == old('post_type', $post->post_type) ? 'selected' : '' }}>{{ $val['label'] }}</option>
        @endforeach
        </select>
    </div>

    <div class="form-parts">
        <label for="title">タイトル</label><br>
        <input type="text" name="title" value="{{old('title', $post->title)}}" placeholder="タイトル">
    </div>

    <div class="form-parts">
        <label for="part">パート</label><br>
        @foreach(\App\User::PART as $key => $val)
        @if(!($key == 0))
            <input type="checkbox" name="parts[]" id="part" value="{{ $key }}"
            @for($i=1; $i<=7; $i++)
            {{ $key == old('parts[$i]', $post_parts[$i]) ? 'checked' : '' }}
            @endfor>{{ $val['label'] }}
        @endif
        @endforeach
    </div>

    <div class="form-parts">
        <label for="stance">活動スタンス</label><br>
        <select name="stance" id="stance">
            @foreach(\App\Post::STANCE as $key => $val)
            <option value="{{ $key }}" {{ $key == old('stance', $post->stance) ? 'selected' : '' }}>{{ $val['label'] }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-parts">
        <label for="">活動地域</label><br>
        <p>北海道地方</p>
        @foreach(\App\User::AREA as $key => $val)
            @if($val['area'] == '北海道地方')
            <input type="checkbox" name="areas[]" id="" value="{{ $key }}" 
                @for($i=0; $i<=4; $i++)
                    {{ $key == old('areas[$i]', $post_areas[$i]) ? 'checked' : '' }}
                @endfor>
                {{ $val['label'] }}
            @endif
        @endforeach

        <p>東北地方</p>
        @foreach(\App\User::AREA as $key => $val)
            @if($val['area'] == '東北地方')
            <input type="checkbox" name="areas[]" id="" value="{{ $key }}" 
                @for($i=0; $i<=4; $i++)
                    {{ $key == old('areas[$i]', $post_areas[$i]) ? 'checked' : '' }}
                @endfor>
                {{ $val['label'] }}
            @endif
        @endforeach

        <p>関東地方</p>
        @foreach(\App\User::AREA as $key => $val)
            @if($val['area'] == '関東地方')
            <input type="checkbox" name="areas[]" id="" value="{{ $key }}" 
                @for($i=0; $i<=4; $i++)
                    {{ $key == old('areas[$i]', $post_areas[$i]) ? 'checked' : '' }}
                @endfor>
                {{ $val['label'] }}
            @endif
        @endforeach

        <p>中部地方</p>
        @foreach(\App\User::AREA as $key => $val)
            @if($val['area'] == '中部地方')
            <input type="checkbox" name="areas[]" id="" value="{{ $key }}" 
                @for($i=0; $i<=4; $i++)
                    {{ $key == old('areas[$i]', $post_areas[$i]) ? 'checked' : '' }}
                @endfor>
                {{ $val['label'] }}
            @endif
        @endforeach

        <p>関西地方</p>
        @foreach(\App\User::AREA as $key => $val)
            @if($val['area'] == '関西地方')
            <input type="checkbox" name="areas[]" id="" value="{{ $key }}" 
                @for($i=0; $i<=4; $i++)
                    {{ $key == old('areas[$i]', $post_areas[$i]) ? 'checked' : '' }}
                @endfor>
                {{ $val['label'] }}
            @endif
        @endforeach

        <p>中国地方</p>
        @foreach(\App\User::AREA as $key => $val)
            @if($val['area'] == '中国地方')
            <input type="checkbox" name="areas[]" id="" value="{{ $key }}" 
                @for($i=0; $i<=4; $i++)
                    {{ $key == old('areas[$i]', $post_areas[$i]) ? 'checked' : '' }}
                @endfor>
                {{ $val['label'] }}
            @endif
        @endforeach

        <p>四国地方</p>
        @foreach(\App\User::AREA as $key => $val)
            @if($val['area'] == '四国地方')
            <input type="checkbox" name="areas[]" id="" value="{{ $key }}" 
                @for($i=0; $i<=4; $i++)
                    {{ $key == old('areas[$i]', $post_areas[$i]) ? 'checked' : '' }}
                @endfor>
                {{ $val['label'] }}
            @endif
        @endforeach

        <p>九州地方</p>
        @foreach(\App\User::AREA as $key => $val)
            @if($val['area'] == '九州地方')
            <input type="checkbox" name="areas[]" id="" value="{{ $key }}" 
                @for($i=0; $i<=4; $i++)
                    {{ $key == old('areas[$i]', $post_areas[$i]) ? 'checked' : '' }}
                @endfor>
                {{ $val['label'] }}
            @endif
        @endforeach

        <p>沖縄地方</p>
        @foreach(\App\User::AREA as $key => $val)
            @if($val['area'] == '沖縄地方')
            <input type="checkbox" name="areas[]" id="" value="{{ $key }}" 
                @for($i=0; $i<=4; $i++)
                    {{ $key == old('areas[$i]', $post_areas[$i]) ? 'checked' : '' }}
                @endfor>
                {{ $val['label'] }}
            @endif
        @endforeach

        <br>
        @foreach(\App\User::AREA as $key => $val)
            @if($val['area'] == 'その他')
            <input type="checkbox" name="areas[]" id="" value="{{ $key }}" 
                @for($i=0; $i<=4; $i++)
                    {{ $key == old('areas[$i]', $post_areas[$i]) ? 'checked' : '' }}
                @endfor>
                {{ $val['label'] }}
            @endif
        @endforeach
    </div>

    <div class="form-parts">
        <label for="body">本文</label><br>
        <textarea name="body" id="body" cols="30" rows="10">{{ old('body', $post->body) }}</textarea>
    </div>

    <div class="btn-box">
        <button class="btn" type="submit">更新する</button>
    </div>

</form>
@endsection