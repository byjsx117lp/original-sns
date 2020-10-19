<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Room;
use App\RoomMember;
use App\User;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();

        $rooms = Room::query()
            ->whereHas('members', function($query) use ($user){
                $query->where('user_id', $user->id);
            })
            ->orderBy('updated_at', 'desc')->paginate(10);
        
        
        return view('messages.index',['rooms' => $rooms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $user)
    {
        //
        $loginUser = Auth::user();
        $room = Room::query()
            ->whereHas('members', function($query) use ($loginUser) {
                $query->where('user_id', $loginUser->id);
            })
            ->whereHas('members', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->first();

        if(!$room) {
            $room = Room::create();
            $room->members()->createMany([
                ['user_id' => $loginUser->id],
                ['user_id' => $user->id],
            ]);
        }

        return  redirect()->route('rooms.show',$room);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($room_id)
    {
        $loginUser = Auth::user();
        $room_member = RoomMember::query()->where([
            ['user_id', $loginUser->id],
            ['room_id', $room_id],
            ])->first();
        
        $user = User::query()
            ->whereHas('members', function($query) use ($room_id) {
                $query->where('room_id', $room_id);
            })
            ->whereHas('members', function($query) use ($loginUser) {
                $query->where('user_id', '<>', $loginUser->id);
            })->first();

        return view('messages.room', ['room_member' => $room_member, 'room_id' => $room_id, 'loginUser' => $loginUser, 'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
