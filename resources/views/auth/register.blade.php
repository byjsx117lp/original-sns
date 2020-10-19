@extends('layouts.layout')

@section('content')

<h1>会員登録</h1>

@if($errors->any())
<div class="alert alert-danger">
    @foreach($errors->all() as $message)
    <p>{{ $message }}</p>
    @endforeach
</div>
@endif

<form action="{{ route('register') }}" method="post" class="form">
    @csrf
    <div class="form-parts">
        <label for="name">名前<span class="required">*必須</span></label><br>
        <input type="text" name="name" id="name" class="" valie="{{ old('name') }}">
    </div>

    <div class="form-parts">
        <label for="email">メールアドレス<span class="required">*必須</span></label><br>
        <input type="text" name="email" id="email" class="" valie="{{ old('email') }}">
    </div>

    <div class="form-parts">
        <label for="password">パスワード<span class="required">*必須</span></label><br>
        <input type="password" name="password" id="password" class="">
    </div>

    <div class="form-parts">
        <label for="password-confirm">パスワード(確認)<span class="required">*必須</span></label><br>
        <input type="password" name="password_confirmation" id="password-confirm" class="">
    </div>

    <div class="form-parts">
        <label for="birth_day">生年月日<span class="required">*必須(この項目は登録後、変更ができません)</span></label><br>
        <input type="date" name="birth_day" id="birth_day" class="" valie="{{ old('bith_day') }}">
    </div>

    <div class="form-parts">
        <label for="gender">性別<span class="required">*必須(この項目は登録後、変更ができません)</span></label><br>
        <select name="gender" id="gender" class="">
        @foreach(\App\User::GENDER as $key => $val)
            <option value="{{ $key }}">{{ $val['label'] }}</option>
        @endforeach
        </select>
    </div>

    <div class="form-parts">
        <label for="residence">居住地<span class="required">*必須</span></label><br>
        <select name="residence" id="residence">
            @foreach(\App\User::AREA as $key => $val)
            <option value="{{ $key }}">{{ $val['label'] }}</option>
            @endforeach
        </select>
    </div>

    <div class="btn-box">
        <button class="btn" type="submit">登録する</button>
    </div>

</form>
@endsection