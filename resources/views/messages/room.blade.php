@extends('layouts.layout')

@section('content')

<h1>メッセージ<br>- to {{ $user->name }} -</h1>

<!-- <button type="button" @click="position()" class="btn">test</button> -->

<div id="message-room">
    <div id="chat">
        <div v-for="message in messages">
            <div v-if="message.room_member_id == {{ $room_member->id }}">
                <div class="self-message">
                    <div class="self-message-content">
                        <div>
                            <span>{{ $loginUser->name }}</span>
                        </div>
                        <div class="self-remark">
                            <pre><p v-text="message.message"></p></pre>
                        </div>
                        <div>
                            <span class="message-created">@{{ message.created_at | dateTime }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else>
                <div class="other-message">
                    <div class="other-message-content">
                        <div>
                            <span>{{ $user->name }}</span>
                        </div>
                        <div class="other-remark">
                            <pre><p v-text="message.message"></p></pre>
                        </div>
                        <div>
                            <span class="message-created">@{{ message.created_at | dateTime }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="message-form" class="row">
            <div id="message-wrap" class="col-10">
                <textarea v-model="message" id="message-area"></textarea>
            </div>
            <div style="display:none">
                <input id="member_id" type="text" v-model="member_id" value="{{ $room_member->id }}">
                <input id="room_id" type="text" v-model="room_id" value="{{ $room_id }}">
            </div>
            <div id="submit-wrap" class="col-2">
                <button type="button" @click="send()" class="btn">送信</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@include('scripts.vue')
@endsection