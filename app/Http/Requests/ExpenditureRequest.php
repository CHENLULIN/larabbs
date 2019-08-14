<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenditureRequest extends FormRequest
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
			'expenditure_money' =>  'required'
		];
	}
	
	public function messages()
	{
		return [
			'expenditure_money.required'    =>  '金额必须填写',
		];
	}
}
