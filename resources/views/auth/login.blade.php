@extends('layouts.layout')

@section('content')

<h1>ログイン</h1>

@if($errors->any())
<div class="alert alert-danger">
    @foreach($errors->all() as $message)
    <p>{{ $message }}</p>
    @endforeach
</div>
@endif

<form action="{{ route('login') }}" method="post" class="form">
    @csrf
    <div class="form-parts">
        <label for="email">メールアドレス</label><br>
        <input type="text" id="email" name="email" value="{{ old('email') }}">
    </div>

    <div class="form-parts">
        <label for="password">パスワード</label><br>
        <input type="password" id="password" name="password">
    </div>

    <div class="btn-box">
        <button class="btn" type="submit">ログイン</button>
    </div>

</form>
@endsection