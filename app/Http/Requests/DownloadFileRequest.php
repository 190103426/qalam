<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DownloadFileRequest extends FormRequest
{

    public function rules()
    {
        return [
            'path' => 'required|string|max:255'
        ];
    }
}
