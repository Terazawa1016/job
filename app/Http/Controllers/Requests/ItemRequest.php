<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
          'name' => 'required|max:50',
          'price' => ['required', 'integer' , 'min:1'],
          'stock' => ['required', 'integer', 'min:1', 'max:999'],
        ];
    }

    public function messages()
    {
      return[
        'name.required' => '名前を入力してください',
        'price.required' => '金額を入力してください',
        'price.integer' => '金額は半角整数で入力してください',
        'price.min' => '金額は1以上で入力してください',
        'stock.required' => '在庫数を入力してください',
        'stock.integer' => '在庫数は半角整数で入力してください',
        'stock.min' => '在庫数は1以上を入力してください',
        'stok.max' => '在庫数は3桁までで入力してください',

      ];
    }
}
