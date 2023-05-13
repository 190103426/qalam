<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{

    public function rules()
    {
        $rules =  [
            'full_name' => 'required|min:3|string',
            'password' => 'required|min:4|string',
            'phone' => 'required|string|unique:users,phone',
        ];
        if ($this->input('email')) {
            $rules['email'] = 'string|email';
        }
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
