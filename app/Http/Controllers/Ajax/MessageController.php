<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RoomMessage;
use App\RoomMember;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Events\MessageCreated;

class MessageController extends Controller
{
    //
    public function index(int $room) {
        return RoomMessage::query()
            ->whereHas('room_member', function($query) use ($room) {
                $query->where('room_id', $room);
            })
            ->orderBy('id', 'asc')->get();
    }

    public function create(Request $request) {
        $member = RoomMember::find($request->member_id);
        if(Auth::user()->id == $member->user_id) {
            $message = $member->messages()
                ->create([
                    'message' => $request->message,
                ]);
            //roomテーブルのlast_message_atを更新
            $last_message_at = Carbon::now();
            $member->room()->update([
                    'last_message_at' => $last_message_at,
                ]);
                
            event(new MessageCreated($message));
        }
    }
}
