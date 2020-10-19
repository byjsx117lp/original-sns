@extends('layouts.layout')

@section('content')

<h1>メッセージ一覧</h1>

@foreach($rooms as $room)

<div id="template">
    <a href="{{ route('rooms.show', ['room' => $room->id]) }}">
        <div class="room">
            <div class="last-message-at">
                @if(!($room->last_message_at == null))
                {{ $room->updated_at->format('m/d-H:i') }}
                @endif
            </div>
            <div class="talk-to">{{ App\Room::talkTo($room) }}</div>
            <div class="last-remark">{{ App\Room::lastRemarkUser($room). App\Room::lastMessage($room) }}</div>
        </div>
    </a>
</div>

@endforeach

@endsection