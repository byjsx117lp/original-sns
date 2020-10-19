<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomMember extends Model
{
    //
    protected $guarded = [
        'id',
    ];

    public function messages() {
        return $this->hasMany('\App\RoomMessage');
    }

    public function room() {
        return $this->belongsTo('\App\Room');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public static function userName($id) {
        $userName = User::find($id)->name();
        return $userName;
    }
}
