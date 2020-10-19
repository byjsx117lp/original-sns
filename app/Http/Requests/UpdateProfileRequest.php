<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\User;
use App\Post;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $parts_rule = Rule::in(array_keys(User::PART));
        $areas_rule = Rule::in(array_keys(User::AREA));
        $years_rule = Rule::in(array_keys(User::YEAR));


        return [
            //
            'name' => 'required|max:30',
            'image_file_name' => 'file|image|max:2028',
            'residence' => 'required|'. $areas_rule,
            'self_introduction' => 'max:1000',
            'part1' => $parts_rule,
            'part2' => $parts_rule,
            'part3' => $parts_rule,
            'part_of_years1' => $years_rule,
            'part_of_yaers2' => $years_rule,
            'part_of?yaers3' => $years_rule,
        ];
    }

    public function attributes()
    {
        return [
            'name' => '名前',
            'image_file_name' => 'プロフィール画像',
            'residence' => '居住地',
            'self_introduction' => '自己紹介',
            'part1' => '楽器1',
            'part2' => '楽器2',
            'part3' => '楽器3',
            'part_of_years1' => '楽器1の歴',
            'part_of_yaers2' => '楽器2の歴',
            'part_of?yaers3' => '楽器3の歴',
        ];
    }
}
