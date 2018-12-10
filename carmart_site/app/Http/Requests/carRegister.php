<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class carRegister extends FormRequest
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
          // company , kind, model,grade,year,
          // distinct, color, gear , accident, oil, carnum,price
          'grade' => 'required',
          'distinct' =>'required',
          'color'=> 'required',
          'accident' =>'required',
          'carnum' => 'required',
          'oil' => 'required',
          'gear' => 'required',
          'year' => 'required',
          'price' => 'required',
          'sumnail_image_num' =>  'required|min:1',
        ];
    }

    public function messages()
    {
        return [
            'grade.required' => '차종 선택부분을 모두 선택해주세요.',
            'distinct.required' => '주행거리를 입력해주세요.',
            'color.required'=>'색상을 입력해주세요.',
            'accident.required' => '사고여부를 선택해주세요',
            'carnum.required' => '차량번호를 입력해주세요.',
            'oil.required' => '연료부분을 선택해주세요.',
            'gear.required' => '변속기부분을 선택해주세요.',
            'year.required' => '연식을 선택해주세요.',
            'price.required' => '가격을 입력해주세요.',
            'sumnail_image_num' => '최소 1개 이상 이미지를 넣어주세요',

        ];
    }
}
