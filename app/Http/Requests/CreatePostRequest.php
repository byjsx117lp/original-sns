<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\User;
use App\Post;

class CreatePostRequest extends FormRequest
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
        $stance_rule = Rule::in(array_keys(Post::STANCE));
        $areas_rule = Rule::in(array_keys(User::AREA));
        $post_type_rule = Rule::in(array_keys(Post::POST_TYPE));

        return [
            //
            'title' => 'required|max:30',
            'parts' => 'required|array|max:8|'. $parts_rule,
            'stance' => 'required|numeric|'. $stance_rule,
            'areas' => 'required|array|max:5|'. $areas_rule,
            'post_type' => 'required|numeric|'. $post_type_rule,
            'body' => 'required|max:1000',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'parts' => 'パート',
            'stance' => 'スンタス',
            'areas' => '活動地域',
            'post_type' => '記事タイプ',
            'body' => '本文',
        ];
    }
}
