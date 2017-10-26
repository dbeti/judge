<?php namespace GoodlerJudge\Http\Controllers;

use GoodlerJudge\Http\Requests;
use GoodlerJudge\Http\Controllers\Controller;

use Illuminate\Http\Request;

class FaqController extends Controller {

	/**
	 *Show Goodler Judge F.A.Q. page
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('faq');
	}

}
