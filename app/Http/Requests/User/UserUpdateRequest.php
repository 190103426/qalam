<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = auth()->user();
        $rules =  [
            'full_name' => 'required|min:3|string',
            'phone' => 'required|string|unique:users,phone, ' . $user->id,
        ];

        $rules['email'] = 'required|string|email|unique:users,email,'.$user->id;
        return $rules;
    }

    public function getValidatorInstance()
    {
        $this->merge([
            'phone' => preg_replace('/[^0-9]/','',$this->phone)
        ]);
        return parent::getValidatorInstance();
    }
}
