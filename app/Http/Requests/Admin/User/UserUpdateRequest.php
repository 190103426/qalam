<?php

namespace App\Http\Requests\Admin\User;

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
//        $this->merge(['phone' => preg_replace('/[^0-9]/','',$this->phone)]);
        $rules =  [
            'full_name' => 'required|min:3|string',
            'phone' => 'required|min:11|unique:users,phone,'.$this->route('user')
        ];
        if ($this->input('password')) {
            $rules['password'] = 'min:4|string';
        }
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
