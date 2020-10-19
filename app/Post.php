<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $gurded =[
        'id',
    ];
    
    const POST_TYPE = [
        1 => ['label' => 'メンバー募集'],
        2 => ['label' => '加入希望'],
    ];

    const STANCE = [
        1 => ['label' => 'アマチュア'],
        2 => ['label' => 'プロ'],
        3 => ['label' => 'セミプロ'],
        4 => ['label' => 'その他'],
    ];

    const ORDER = [
        'desc' => ['label' => '新しい順'],
        'asc' => ['label' => '古い順'],
    ];

    public function user() {
        $this->belongsTo('App/User');
    }

    public function bookmark() {
        return $this->belongsToMany('App\User', 'bookmarks', 'post_id', 'user_id')->withTimestamps();
    }
}
