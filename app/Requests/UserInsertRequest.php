<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UserInsertRequest extends FormRequest
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
            'name' => 'required|max:64',
            'id' => 'required|max:255|unique:user_tbl,id',
            'email' => 'required|max:255|unique:user_tbl,email',
            'nickname' => 'max:255',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            '_method' => Str::slug($this->_method),
            '_token' => Str::slug($this->_token),
        ]);
    }
}
