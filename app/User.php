<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const GENDER = [
        1 => ['label' => '男性'],
        2 => ['label' => '女性'],
    ];

    const AREA = [
        1 => ['label' => '北海道', 'area' => '北海道地方'],
        2 => ['label' => '青森県', 'area' => '東北地方'],
        3 => ['label' => '岩手県', 'area' => '東北地方'],
        4 => ['label' => '宮城県', 'area' => '東北地方'],
        5 => ['label' => '秋田県', 'area' => '東北地方'],
        6 => ['label' => '山形県', 'area' => '東北地方'],
        7 => ['label' => '福島県', 'area' => '東北地方'],
        8 => ['label' => '茨城県', 'area' => '関東地方'],
        9 => ['label' => '栃木県', 'area' => '関東地方'],
        10 => ['label' => '群馬県', 'area' => '関東地方'],
        11 => ['label' => '埼玉県', 'area' => '関東地方'],
        12 => ['label' => '千葉県', 'area' => '関東地方'],
        13 => ['label' => '東京都', 'area' => '関東地方'],
        14 => ['label' => '神奈川県', 'area' => '関東地方'],
        15 => ['label' => '新潟県', 'area' => '中部地方'],
        16 => ['label' => '富山県', 'area' => '中部地方'],
        17 => ['label' => '石川県', 'area' => '中部地方'],
        18 => ['label' => '福井県', 'area' => '中部地方'],
        19 => ['label' => '山梨県', 'area' => '中部地方'],
        20 => ['label' => '長野県', 'area' => '中部地方'],
        21 => ['label' => '岐阜県', 'area' => '中部地方'],
        22 => ['label' => '静岡県', 'area' => '中部地方'],
        23 => ['label' => '愛知県', 'area' => '中部地方'],
        24 => ['label' => '三重県', 'area' => '関西地方'],
        25 => ['label' => '滋賀県', 'area' => '関西地方'],
        26 => ['label' => '京都府', 'area' => '関西地方'],
        27 => ['label' => '大阪府', 'area' => '関西地方'],
        28 => ['label' => '兵庫県', 'area' => '関西地方'],
        29 => ['label' => '奈良県', 'area' => '関西地方'],
        30 => ['label' => '和歌山県', 'area' => '関西地方'],
        31 => ['label' => '鳥取県', 'area' => '中国地方'],
        32 => ['label' => '島根県', 'area' => '中国地方'],
        33 => ['label' => '岡山県', 'area' => '中国地方'],
        34 => ['label' => '広島県', 'area' => '中国地方'],
        35 => ['label' => '山口県', 'area' => '中国地方'],
        36 => ['label' => '徳島県', 'area' => '四国地方'],
        37 => ['label' => '香川県', 'area' => '四国地方'],
        38 => ['label' => '愛媛県', 'area' => '四国地方'],
        39 => ['label' => '高知県', 'area' => '四国地方'],
        40 => ['label' => '福岡県', 'area' => '九州地方'],
        41 => ['label' => '佐賀県', 'area' => '九州地方'],
        42 => ['label' => '長崎県', 'area' => '九州地方'],
        43 => ['label' => '熊本県', 'area' => '九州地方'],
        44 => ['label' => '大分県', 'area' => '九州地方'],
        45 => ['label' => '宮崎県', 'area' => '九州地方'],
        46 => ['label' => '鹿児島県', 'area' => '九州地方'],
        47 => ['label' => '沖縄県', 'area' => '沖縄地方'],
        48 => ['label' => 'その他', 'area' => 'その他'],
    ];

    const YEAR = [
        0 => ['label' => '未選択'],
        1 => ['label' => '1年未満'],
        2 => ['label' => '1年以上'],
        3 => ['label' => '3年以上'],
        4 => ['label' => '5年以上'],
        5 => ['label' => '10年以上'],
        6 => ['label' => '15年以上'],
        7 => ['label' => '20年以上'],
        8 => ['label' => '25年以上'],
    ];

    const PART = [
        0 => ['label' => '未選択'],
        1 => ['label' => 'ボーカル'],
        2 => ['label' => 'ギター'],
        3 => ['label' => 'ベース'],
        4 => ['label' => 'ドラム'],
        5 => ['label' => 'ピアノ、キーボード'],
        6 => ['label' => '管楽器'],
        7 => ['label' => '作詞作曲、アレンジャー'],
        8 => ['label' => 'その他'],
    ];

    public static function year($part_of_year) {
        $year = self::YEAR[$part_of_year];
        return $year['label'];
    }

    public function posts() {
        return $this->hasMany('App\Post');
    }

    public function bookmarks() {
        return $this->belongsToMany('App\Post', 'bookmarks', 'user_id', 'post_id')->withTimestamps();
    }

    public function is_bookmarks($postId) {
        return $this->bookmarks()->where('post_id', $postId)->exists();
    }

    public function add_bookmark($postId) {
        $exist = $this->is_bookmarks($postId);

        if($exist) {
            return false;
        } else {
            $this->bookmarks()->attach($postId);

            return true;
        }
    }

    public function take_bookmark($postId) {
        $exist = $this->is_bookmarks($postId);

        if($exist) {
            $this->bookmarks()->detach($postId);
        } else {
            return false;
        }
    }

    public static function age($id) {
        $birthDay = User::find($id)->birth_day;
        $now = date("Ymd");
        $birthDay = str_replace('-', '', $birthDay);
        return floor(($now - $birthDay)/10000).'歳';
    }

    public function members() {
        return $this->hasMany('App\RoomMember');
    }
}

