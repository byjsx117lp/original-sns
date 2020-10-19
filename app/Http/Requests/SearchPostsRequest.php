<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\User;
use App\Post;

class SearchPostsRequest extends FormRequest
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
            'parts' => 'array|max:8|'. $parts_rule,
            'stance' => 'required|numeric|'. $stance_rule,
            'areas' => 'array|max:5|'. $areas_rule,
            'post_type' => 'required|numeric|'. $post_type_rule,
        ];
    }

    public function attributes() {
        $attributes = parent::attributes();

        return $attributes + [

        ];
    }
}
