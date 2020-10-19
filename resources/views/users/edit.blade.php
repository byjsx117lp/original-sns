@extends('layouts.layout')

@section('content')

@if($id == Auth::user()->id)

<h1>プロフィール編集</h1>

@if($errors->any())
<div class="alert alert-danger">
    @foreach($errors->all() as $message)
    <p class="area">{{ $message }}</p>
    @endforeach
</div>
@endif


<form action="{{ route('users.update', ['user' => $id]) }}" method="post" enctype="multipart/form-data" class="form">
    @csrf
    @method('put')
    <div class="form-parts">
        <label for="name">名前</label>
        <br>
        <input name="name" id="name" class="" type="text" value="{{ old('name', $user->name) }}">
    </div>

    <div class="form-parts">
        <label for="image_file_name">プロフィール画像</label>
        <br>
        <input name="image_file_name" id="image_file_name" class="" type="file" value="{{ $user->image_file_name }}" style="background-color: rgba(255, 255, 255, 0)">
    </div>

    <div class="form-parts">
        <label for="residence">居住地</label>
        <br>
        <select name="residence" id="residence" class="">
            @foreach(\App\User::AREA as $key => $val)
            <option value="{{ $key }}" {{ $key == old('rensidence', $user->residence) ? 'selected' : '' }}>
                {{ $val['label'] }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-parts">
        <label for="part1">パート1</label>
        <select name="part1" id="part1">
            @foreach(\App\User::PART as $key => $val)
            <option value="{{ $key }}" {{ $key == old('part1', $user->part1) ? 'selected' : ''}}>{{ $val['label'] }}</option>
            @endforeach
        </select>

        <label for="part_of_years1">歴</label>
        <select name="part_of_years1" id="part_of_years1">
            @foreach(App\User::YEAR as $key => $val)
            <option value="{{ $key }}" {{ $key == old('part_of_years1', $user->part_of_years1) ? 'selected' : '' }}>{{ $val['label'] }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-parts">
        <label for="part2">パート2</label>
        <select name="part2" id="part2">
            @foreach(\App\User::PART as $key => $val)
            <option value="{{ $key }}" {{ $key == old('part2', $user->part2) ? 'selected' : ''}}>{{ $val['label'] }}</option>
            @endforeach
        </select>

        <label for="part_of_years2">歴</label>
        <select name="part_of_years2" id="part_of_years2">
            @foreach(App\User::YEAR as $key => $val)
            <option value="{{ $key }}" {{ $key == old('part_of_years2', $user->part_of_years2) ? 'selected' : '' }}>{{ $val['label'] }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-parts">
        <label for="part3">パート3</label>
        <select name="part3" id="part3">
            @foreach(\App\User::PART as $key => $val)
            <option value="{{ $key }}" {{ $key == old('part3', $user->part3) ? 'selected' : ''}}>{{ $val['label'] }}</option>
            @endforeach
        </select>

        <label for="part_of_years3">歴</label>
        <select name="part_of_years3" id="part_of_years3">
            @foreach(App\User::YEAR as $key => $val)
            <option value="{{ $key }}" {{ $key == old('part_of_years3', $user->part_of_years3) ? 'selected' : '' }}>{{ $val['label'] }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-parts">
        <label for="self_introduction">自己紹介欄</label>
        <br>
        <textarea name="self_introduction" id="body" cols="50"
            rows="10">{{ old('self-introduction', $user->self_introduction) }}</textarea>
    </div>

    <div class="btn-box">
        <button class="btn" type="submit">更新する</button>
    </div>

</form>
@endif

@endsection