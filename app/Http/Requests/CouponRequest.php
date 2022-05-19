<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'code' => 'required|min:6|max:20|unique:coupons,code,' . $this->segment(3),//получаем сегмент 3, то есть 3 каталог в URL
            'value' => 'required|numeric|min:0',
            'currency_id' => 'max:1000000|required_with:type',
            'description' => 'max:3000'
        ];
    }
}
