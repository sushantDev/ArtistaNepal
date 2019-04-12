<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegister extends FormRequest
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
            'name'     => 'required|max:200',
            'username' => 'required|max:25|unique:users,username',
            'email'    => 'required',
            'password' => 'required|confirmed',
            'role'     => 'required|exists:roles,name'
        ];
    }

    public function data()
    {
        $data = [
            'name'     => $this->get('name'),
            'username' => str_slug($this->get('username')),
            'email'    => $this->get('email'),
            'password' => bcrypt($this->get('password'))
        ];

        return $data;
    }
}
