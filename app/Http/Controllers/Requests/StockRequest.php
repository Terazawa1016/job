<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockRequest extends FormRequest
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

          'stock' => ['required', 'integer', 'min:1', 'max:999'],
        ];
    }

    public function messages()
    {
      return[
        'stock.required' => '在庫数を入力してください',
        'stock.integer' => '在庫数は半角整数で入力してください',
        'stock.min' => '在庫数は1以上を入力してください',
        'stok.max' => '在庫数は3桁までで入力してください',

      ];
    }
}
