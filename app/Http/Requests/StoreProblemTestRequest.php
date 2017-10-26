<?php namespace GoodlerJudge\Http\Requests;

use GoodlerJudge\Http\Requests\Request;

class StoreProblemTestRequest extends Request {

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
			'test_input' => 'required',
			'test_output' => 'required'
		];
	}

}
