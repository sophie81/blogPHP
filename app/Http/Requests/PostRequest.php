<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PostRequest extends Request
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

        return [
            'title' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'integer',
            'status' => 'in:published,unpublished,draft',
            'published_at' => 'date',
            'tag_id' => 'tags',
            'user_id' => 'integer',
            'picture' => 'image|max:3000',
            'name' => 'string|max:50'
        ];
    }
}
