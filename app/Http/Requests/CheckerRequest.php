<?php namespace GoodlerJudge\Http\Requests;

use GoodlerJudge\Http\Requests\Request;

class CheckerRequest extends Request {

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
			'file' => 'required',
			'prog_lang' => 'required|exists:prog_langs,id',
			'name' => 'required'
		];
	}

}
