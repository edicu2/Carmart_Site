<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class counselSMS extends FormRequest
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
          'car1' => 'required',
          'car2' => 'required',
          'checkbox' => 'required',
          'tel' => 'required|min:10|max:11|'
        ];
    }

    public function messages()
    {
        return [
            'car1.required' => '제조사를 선택해주세요.',
            'car2.required' => '차 총을 선택해주세요.',
            'checkbox.required'=>'개인정보처리 동의를 선택해주세요.',
            'tel.required' => '연락처를 입력해주세요. ',
            'tel.min' => '연락처를 최소 10글자 이상입니다.',
        ];
    }
}
