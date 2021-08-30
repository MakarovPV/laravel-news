<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:50|max:255|string|',
            'short_description' => 'required|min:200|max:1000|string|',
            'full_description' => 'required|min:50|max:50000|string|',
            'news_picture' => 'required|image',
        ];
    }
}
