<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForumSubcategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subcategory_name' => 'required|min:5|max:100|string|unique:forum_subcategories',
            'comment' => 'required|min:5|max:400|string',  
        ];
    }
}
