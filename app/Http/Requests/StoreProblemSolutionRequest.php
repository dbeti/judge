<?php namespace GoodlerJudge\Http\Requests;

use GoodlerJudge\Http\Requests\Request;

/**
 * StoreProblemSolutionRequest validates problem submission requests.
 */
class StoreProblemSolutionRequest extends Request {

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
	 * @return array validation rules for request
	 */
	public function rules()
	{
		return [
			'source' => 'required',
			'language' => 'required|exists:prog_langs,id',
		];
	}

}
