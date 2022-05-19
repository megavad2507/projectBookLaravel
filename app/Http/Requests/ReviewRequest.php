<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'text' => 'required|max:3000',
            'grade' => 'required|min:1|max:5',
            'author_name' => 'required|max:20'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для заполнения',
            'min' => 'Поле :attribute должно иметь как минимум :min знаков',
            'max' => 'Поле :attribute должно иметь не более :max знаков'
        ];
    }
}