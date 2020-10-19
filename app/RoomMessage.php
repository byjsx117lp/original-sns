<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomMessage extends Model
{
    //
    protected $guarded = [
        'id',
    ];

    public function room_member() {
        return $this->belongsTo('\App\RoomMember');
    }

    public function room() {
        return $this->belongsTo('App\Room');
    }
}
