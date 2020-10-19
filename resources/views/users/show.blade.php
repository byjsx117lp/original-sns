@extends('layouts.layout')

@section('content')

<h1>プロフィール</h1>

<div id="template">
    <div class="row">
        <div id="user-basic-info" class="col-12">
            <div id="image-wrap">
                <img src="/storage/{{ $user->image_file_name }}" alt="prof-img" id="prof-img">
            </div>
            <div class="col-12" id="user">
                <p class="name">
                    {{ \App\User::find($user->id)->name }}
                </p>

                @foreach(\App\User::AREA as $key => $val)
                @if(\App\User::find($user->id)->residence == $key)
                <p class="residence">
                    {{$val['label']}}
                </p>
                @endif
                @endforeach

                @foreach(\App\User::GENDER as $key => $val)
                @if(\App\User::find($user->id)->gender == $key)
                <p class="gender-age">
                    {{ $val['label'] }} / {{ \App\User::age($user->id) }}
                </p>
                @endif
                @endforeach
            </div>
        </div>
        <div class="col-12 contents" id="parts">
            <h2>扱える楽器・パート/ 経験年数</h2>
            @foreach(\App\User::PART as $key => $val)
            @if(!($user->part1 == 0) && $user->part1 == $key)
            <p>
                ・{{ $val['label'] }} / {{ \App\User::year($user->part_of_years1) }}
            </p>
            @elseif(!($user->part2 == 0) && $user->part2 == $key)
            <p>
                ・{{ $val['label'] }} / {{ \App\User::year($user->part_of_years2) }}
            </p>
            @elseif(!($user->part3 == 0) && $user->part3 == $key)
            <p>
                ・{{ $val['label'] }} / {{ \App\User::year($user->part_of_years3) }}
            </p>
            @endif
            @endforeach
        </div>
        <div class="col-12 contents" id="self-introduction">
            <h2>自己紹介</h2>
            <pre><p>{{ $user->self_introduction }}</p></pre>
        </div>
    </div>

    <div class="btn-box">
    @if(Auth::check())
        @if($user->id == Auth::user()->id)
        <a href="{{ route('users.edit', ['user' => Auth::user()->id]) }}">
            <button class="btn">編集する</button>
        </a>
        @else
        <form action="{{ route('rooms.store') }}" method="post">
            @csrf
            <input type="text" name="id" value="{{ $user->id }}" style="display:none">
            <button type="submit" class="btn">メッセージを送る</button>
        </form>
        @endif
    @endif
    </div>
</div>

@endsection