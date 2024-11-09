<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
    public function rules($user)
    {
        return [
            // 'name' => 'required|min:2|max:100',
            // 'city' => 'required|min:2|max:50',
            // 'password' => 'required|min:6|max:50'

            'name' => 'required|string|min:2|max:100',
            'mobile' => 'required|string|min:11|max:11',
            'type' => 'required',
            'city' => 'required|string|min:2|max:50',
            'address' => 'required|string|min:2',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|max:50',
            'avatar' => 'nullable'

        ];
    }
}
