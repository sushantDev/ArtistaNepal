<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePost extends FormRequest {

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
            'title'   => 'required|max:200',
            'content' => 'required',
            'image'   => 'image|max:2048'
        ];
    }

    /**
     * Prepare data array
     *
     * @return array
     */
    public function data()
    {
        $data = [
            'title'            => $this->get('title'),
            'meta_description' => $this->get('meta_description', null),
            'view'             => $this->get('view', 'post.show'),
            'content'          => $this->get('content'),
            'tags'             => $this->get('tags', []),
            'is_published'     => $this->has('publish')
        ];

        return $data;
    }
}
