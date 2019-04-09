<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePost extends FormRequest
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
            'title'   => 'required|max:200',
            'content' => 'required',
            'image'   => 'image|max:2048',
            'file'    => 'nullable|mimes:mp3,wav,mp4,avi'
        ];
    }

    public function data()
    {
        $data = [
            'user_id'          => auth()->id(),
            'title'            => $this->get('title'),
            'meta_description' => $this->get('meta_description', null),
            'view'             => empty($this->get('view')) ? 'post.full-width' : $this->get('view'),
            'content'          => $this->get('content'),
            'tags'             => $this->get('tags', []),
            'is_featured'      => $this->has('is_featured'),
            'is_published'     => $this->has('publish')
        ];

        return $data;
    }
}
