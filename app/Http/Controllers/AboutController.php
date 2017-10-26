<?php namespace GoodlerJudge\Http\Controllers;

use GoodlerJudge\Http\Requests;
use GoodlerJudge\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AboutController extends Controller {
	/**
	 * Show Goodler Judge about page.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('about');
	}

}
