<?php

namespace App\Http\Requests\Admin\Course;

use Illuminate\Foundation\Http\FormRequest;

class CourseUpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules =  [
            'name' => 'required|string|min:3|max:255',
//            'description' => 'required|string|min:3',
//            'author' => 'required|string|min:3|max:255',
//            'price' => 'required|integer',
//            'old_price' => 'required|integer',
        ];
        if ($this->hasFile('image')) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg';

        }
        return $rules;
    }
}
