<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:40',
            'title_en' =>'required|max:40',
            'description' => 'max:100',
            'description_en' => 'max:100',
            'button_text' => 'required|max:20',
            'button_text_en' => 'required|max:20',
            'button_href' => 'required|max:30',
        ];
    }
}
