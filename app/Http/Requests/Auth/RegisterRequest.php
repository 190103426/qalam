<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->merge(['phone' => preg_replace('/[^0-9]/','',$this->phone)]);
        $rules =  [
            'full_name' => 'required|string|min:3',
            'phone' => 'required|string|unique:users,phone',
//            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|min:4|string|confirmed',
            'password_confirmation' => 'required|string|min:4|max:191|same:password',
            'confirm_policy' => 'required|in:true,1',
        ];

        if ($this->input('email')) {
//            $rules['phone'] = 'required|string|min:18|max:18';
            $rules['email'] = 'required|string|email';
        }
        return $rules;
    }
}
