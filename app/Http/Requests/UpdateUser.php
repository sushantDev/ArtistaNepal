<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return auth()->id() == $this->user->id || true; //if admin
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'name'             => 'required|max:200',
            'username'         => 'required|max:25|unique:users,username,'.$this->user->id,
            'email'            => 'required',
            'password'         => 'confirmed',
            'role'             => 'required|exists:roles,name'
        ];
    }

    /**
     * @return array
     */
    public function data()
    {
        $data = [
            'name'     => $this->get('name'),
            'username' => str_slug($this->get('username')),
            'email'    => $this->get('email'),
            'password' => bcrypt($this->get('password'))
        ];
        if ($this->has('password'))
        {
            $data['password'] = bcrypt($this->get('password'));
        }

        $data['status'] = $this->has('status');

        return $data;
    }
}
