<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\RoomMember;
use App\User;
use Carbon\Carbon;

class Room extends Model
{
    //
    protected $guarded = [
        'id',
    ];

    public function members() {
        return $this->hasMany('App\RoomMember');
    }

    public static function talkTo($room) {
        $loginUser = Auth::User();
        $talkingUser = User::query()
            ->whereHas('members', function($query) use ($room, $loginUser) {
                $query->where([
                    ['room_id', $room->id],
                    ['user_id', '<>', $loginUser->id],
                ]);
            })
            ->first();

        $userName = $talkingUser->name;        

        return $userName;
    }

    public static function lastMessage($room) {
        if($room->last_message_at) {
            $lastMessage = RoomMessage::select('room_messages.*')
                ->join('room_members', 'room_members.id', '=', 'room_messages.room_member_id')
                ->where('room_members.room_id', $room->id)
                ->orderBy('created_at', 'desc')
                ->first();

            $lastMessage = $lastMessage->message;
        
            return $lastMessage;
        }
    }

    public static function lastRemarkUser($room) {
        if($room->last_message_at) {
            $lastMessage = RoomMessage::select('room_messages.*')
                ->join('room_members', 'room_members.id', '=', 'room_messages.room_member_id')
                ->where('room_members.room_id', $room->id)
                ->orderBy('created_at', 'desc')
                ->first();

            $lastRemarkId = $lastMessage->room_member_id;
            
            $lastRemarkUser = User::query()
                ->whereHas('members', function($query) use ($lastRemarkId) {
                    $query->where('id', $lastRemarkId);
                })
                ->first();

            $lastRemarkUserName = $lastRemarkUser->name.' ： ';

            return $lastRemarkUserName;
        }
    }
}
