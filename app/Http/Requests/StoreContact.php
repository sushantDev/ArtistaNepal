<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreContact extends FormRequest
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
            'sen_name'  => '',
            'sen_email' => '',
            'rec_name'  => '',
            'rec_email' => '',
            'message'   => '',
            'subject'   => '',
            'price'     => '',
            'date'      => '',
            'venue'     => ''
        ];
    }

    public function data()
    {
        $name = User::where('email', $this->input('email'))->pluck('name');

        $data = [
            'sen_name'  => Auth::user()->name,
            'sen_email' => Auth::user()->email,
            'rec_name'  => $name[0],
            'rec_email' => $this->input('email'),
            'message'   => $this->input('message'),
            'subject'   => $this->input('subject'),
            'price'     => $this->input('price'),
            'date'      => $this->input('date'),
            'venue'     => $this->input('venue')
        ];

        return $data;
    }
}
