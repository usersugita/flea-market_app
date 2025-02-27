<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'postcode' => ['required', 'regex:/^\d{3}-\d{4}$/'], // ハイフン付き7桁
            'address' => ['required', 'string', 'max:255'], // 住所は必須、255文字以内
            'building' => ['required', 'string', 'max:255'], // 建物名は任意、255文字以内
        ];
    }
    public function messages()
    {
        return [
            'postcode.required' => '郵便番号を入力してください',
            'postcode.regex' => 'ハイフンありの８文字で入力してください。',
            'address.required' => '住所を入力してください',
            'building.required' => '建物名を入力してください',

        ];
    }
}
