<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreEvent extends FormRequest
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
            'title'      => 'required',
            'start_date' => 'required',
            'end_date'   => 'required'
        ];
    }

    public function data()
    {
        $data = [
            'user_id'    => Auth::id(),
            'title'      => $this->get('title'),
            'start_date' => $this->get('start_date'),
            'end_date'   => $this->get('end_date')
        ];

        return $data;
    }
}
