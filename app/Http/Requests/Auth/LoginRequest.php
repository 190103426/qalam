<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->merge(['phone' => preg_replace('/[^0-9]/','',$this->phone)]);
        return [
            'phone' => 'required|string',
            'password' => 'required|string|min:6'
        ];
    }
}
