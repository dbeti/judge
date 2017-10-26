<?php namespace GoodlerJudge\Http\Requests;

use GoodlerJudge\Http\Requests\Request;

class ContactFormRequest extends Request {

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
			'name' => 'required|min:3|max:20',
			'email' => 'required|email',
			'web' => 'required',
			'message' => 'required|min:10|max:200'
		];
	}

}
