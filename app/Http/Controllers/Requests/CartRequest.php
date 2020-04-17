<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
          'amount' => ['required', 'integer','min:1', 'max:999'],
        ];
    }

    public function messages()
    {
      return [
        'amount.required' => '数量は必ず入力してください',
        'amount.integer' => '数量は半角整数で入力してください',
        'amount.min' => '数量は1以上で入力してください',
        'amount.max' => '数量は3桁以下で入力してください',
      ];
    }
}
