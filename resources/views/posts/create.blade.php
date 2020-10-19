@extends('layouts.layout')

@section('content')

<h1>記事作成</h1>

@if($errors->any())
<div class="alert alert-danger">
    @foreach($errors->all() as $message)
    <p class="area">{{ $message }}</p>
    @endforeach
</div>
@endif

<form action="{{ route('posts.store') }}" method="post" class="form">
    @csrf

    <div class="form-parts">
        <label for="post_type">記事タイプ<span class="required">*必須</span></label><br>
        <select name="post_type" id="post_type">
            @foreach(\App\Post::POST_TYPE as $key => $val)
            <option value="{{ $key }}">{{ $val['label'] }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-parts">
        <label for="title">タイトル<span class="required">*必須(30文字まで入力できます)</span></label><br>
        <input type="text" name="title" value="{{old('title')}}">
    </div>

    <div class="form-parts">
        <label for="part">パート<span class="required">*必須</span></label><br>
        @foreach(\App\User::PART as $key => $val)
        @if(!($key == 0))
        <input type="checkbox" name="parts[]" id="part" value="{{ $key }}" 
            @for($i=1; $i<=7; $i++)
            {{ $key == old('parts[$i]') ? 'checked' : '' }} 
            @endfor>{{ $val['label'] }}
        @endif
        @endforeach
    </div>

    <div class="form-parts">
        <label for="stance">活動スタンス<span class="required">*必須</span></label><br>
        <select name="stance" id="stance">
            @foreach(\App\Post::STANCE as $key => $val)
            <option value="{{ $key }}" {{ $key == old('stance') ? 'selected' : '' }}>{{ $val['label'] }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-parts">
        <label for="">活動地域<span class="required">*必須(5ヵ所まで選択できます)</span></label>
        <div class="area">
            <p>北海道地方</p>
            @foreach(\App\User::AREA as $key => $val)
            @if($val['area'] == '北海道地方')
            <input type="checkbox" name="areas[]" id="" value="{{ $key }}" @for($i=0; $i<=4; $i++)
                {{ $key == old('areas[$i]') ? 'checked' : '' }} @endfor>>{{ $val['label'] }}
            @endif
            @endforeach
        </div>

        <div class="area">
            <p class="area">東北地方</p>
            @foreach(\App\User::AREA as $key => $val)
            @if($val['area'] == '東北地方')
            <input type="checkbox" name="areas[]" id="" value="{{ $key }}" @for($i=0; $i<=4; $i++)
                {{ $key == old('areas[$i]') ? 'checked' : '' }} @endfor>{{ $val['label'] }}
            @endif
            @endforeach
        </div>

        <div class="area">
            <p class="area">関東地方</p>
            @foreach(\App\User::AREA as $key => $val)
            @if($val['area'] == '関東地方')
            <input type="checkbox" name="areas[]" id="" value="{{ $key }}" @for($i=0; $i<=4; $i++)
                {{ $key == old('areas[$i]') ? 'checked' : '' }} @endfor>{{ $val['label'] }}
            @endif
            @endforeach
        </div>

        <div class="area">
            <p class="area">中部地方</p>
            @foreach(\App\User::AREA as $key => $val)
            @if($val['area'] == '中部地方')
            <input type="checkbox" name="areas[]" id="" value="{{ $key }}" @for($i=0; $i<=4; $i++)
                {{ $key == old('areas[$i]') ? 'checked' : '' }} @endfor>{{ $val['label'] }}
            @endif
            @endforeach
        </div>

        <div class="area">
            <p class="area">関西地方</p>
            @foreach(\App\User::AREA as $key => $val)
            @if($val['area'] == '関西地方')
            <input type="checkbox" name="areas[]" id="" value="{{ $key }}" @for($i=0; $i<=4; $i++)
                {{ $key == old('areas[$i]') ? 'checked' : '' }} @endfor>{{ $val['label'] }}
            @endif
            @endforeach
        </div>

        <div class="area">
            <p class="area">中国地方</p>
            @foreach(\App\User::AREA as $key => $val)
            @if($val['area'] == '中国地方')
            <input type="checkbox" name="areas[]" id="" value="{{ $key }}" @for($i=0; $i<=4; $i++)
                {{ $key == old('areas[$i]') ? 'checked' : '' }} @endfor>{{ $val['label'] }}
            @endif
            @endforeach
        </div>

        <div class="area">
            <p class="area">四国地方</p>
            @foreach(\App\User::AREA as $key => $val)
            @if($val['area'] == '四国地方')
            <input type="checkbox" name="areas[]" id="" value="{{ $key }}" @for($i=0; $i<=4; $i++)
                {{ $key == old('areas[$i]') ? 'checked' : '' }} @endfor>{{ $val['label'] }}
            @endif
            @endforeach
        </div>

        <div class="area">
            <p class="area">九州地方</p>
            @foreach(\App\User::AREA as $key => $val)
            @if($val['area'] == '九州地方')
            <input type="checkbox" name="areas[]" id="" value="{{ $key }}" @for($i=0; $i<=4; $i++)
                {{ $key == old('areas[$i]') ? 'checked' : '' }} @endfor>{{ $val['label'] }}
            @endif
            @endforeach
        </div>

        <div class="area">
            <p class="area">沖縄地方</p>
            @foreach(\App\User::AREA as $key => $val)
            @if($val['area'] == '沖縄地方')
            <input type="checkbox" name="areas[]" id="" value="{{ $key }}" @for($i=0; $i<=4; $i++)
                {{ $key == old('areas[$i]') ? 'checked' : '' }} @endfor>{{ $val['label'] }}
            @endif
            @endforeach
        </div>

        <div class="area">
            @foreach(\App\User::AREA as $key => $val)
            @if($val['area'] == 'その他')
            <input type="checkbox" name="areas[]" id="" value="{{ $key }}" @for($i=0; $i<=4; $i++)
                {{ $key == old('areas[$i]') ? 'checked' : '' }} @endfor>{{ $val['label'] }}
            @endif
            @endforeach
        </div>
    </div>


    <div class="form-parts">
        <label for="body">本文<span class="required">*必須(最大1000文字まで入力できます)</span></label><br>
        <textarea name="body" id="body" cols="30" rows="10"></textarea>
    </div>

    <div class="btn-box">
        <button class="btn" type="submit">投稿する</button>
    </div>

</form>
@endsection