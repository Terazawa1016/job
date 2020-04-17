<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
          'comment' => 'required|max:500',
        ];
    }

    public function messages()
    {
      return[
        'name.required' => '名前を入力してください',
        'name.max' => '名前は50文字以内で入力してください',
        'comment.required' => 'コメントを入力してください',
        'comment.max' => 'コメントは500文字以内で入力してください',
      ];
    }
}
