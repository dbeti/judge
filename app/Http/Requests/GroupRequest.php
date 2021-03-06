<?php namespace GoodlerJudge\Http\Requests;

use GoodlerJudge\Http\Requests\Request;

class GroupRequest extends Request {

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
			'name' => 'required|min:3',
			'user_list' => 'required',
			//'problem_list' => 'required'
		];
	}

}
