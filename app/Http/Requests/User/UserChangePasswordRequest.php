<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserChangePasswordRequest extends FormRequest
{

    public function rules()
    {
        return [
            'password' => 'required|min:4|string|confirmed',
            'password_confirmation' => 'required|string|min:4|max:191|same:password'
        ];
    }
}
