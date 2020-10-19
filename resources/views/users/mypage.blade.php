@extends('layouts.layout')

@section('content')

<h1>マイページ</h1>

<div id="template">
    <div class="btn-box">
        <a href="{{ route('users.show', ['user' => Auth::user()->id]) }}">
            <button class="btn" type="submit">プロフィール</button>
        </a>
    </div>
    <div class="btn-box">
        <a href="{{ route('rooms.index') }}">
            <button class="btn" type="submit">メッセージ一覧</button>
        </a>
    </div>
    <div class="btn-box">
        <a href="{{ route('posts.write') }}">
            <button class="btn" type="submit">投稿記事一覧</button>
        </a>
    </div>
    <div class="btn-box">
        <a href="{{ route('bookmarks', ['user' => Auth::user()->id]) }}">
            <button class="btn" type="submit">ブックマーク一覧</button>
        </a>
    </div>
</div>

@endsection