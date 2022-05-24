<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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

        $user = $this->user;
        if(is_null($user)) {
            $user = $this->user();
        }
        $rulesArray =
        [
            'name' => ['required','min:5','max:40'],
            'email' => ['required','email',Rule::unique('users')->ignore($user)]
        ];
        $actionMethod = $this->route()->getActionMethod();
        if(!(($actionMethod == 'update' || $actionMethod == 'editInfoUpdate') && is_null($this->input('password')))) {
            $rulesArray['password'] = ['required','string','min:8','max:20','confirmed'];
        }
        return $rulesArray;
    }
}
