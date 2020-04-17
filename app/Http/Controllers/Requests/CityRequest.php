<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
          'title' => 'required|max:50',
          'price' => 'required|numeric|digits_between:1,7',
          'image' => 'file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2000',
          'category' => 'required',
          'date' => 'required',
          'time' => 'required',
          'pref' => 'required',
          'place' => 'required',
          'detail' => 'required|max:500',
          'capacity' => 'required|numeric|digits_between:1,4',
        ];
    }

    public function messages()
    {
      return[
        'title.required' => '名前を入力してください',
        'title.max' => '名前は50文字以内で入力してください',
        'price.required' => '金額を入力してください',
        'price.digits_between' => '金額は1~7桁までで入力してください',
        'price.numeric' => '金額は半角数字で入力してください',
        'category.required' => 'カテゴリーを選択してください',
        'date.required' => '日付を選択してください',
        'time.required' => '時間を選択してください',
        'pref.required' => '県名を選択してください',
        'plece.required' => '市区町村を選択してください',
        'detail.required' => '詳細を記入してください',
        'detail.max' => '詳細は500文字以内で入力してください',
        'capacity.required' => '定員数を入力してください',
        'capacity.digits_between' => '定員数は1~4桁までで入力してください',
        'capacity.numeric' => '定員数は半角数字で入力してください'
      ];
    }
}
