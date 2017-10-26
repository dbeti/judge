<?php namespace GoodlerJudge\Http\Controllers;

use GoodlerJudge\Http\Requests;
use GoodlerJudge\Http\Controllers\Controller;

use GoodlerJudge\Problem;
use GoodlerJudge\User;
use Illuminate\Http\Request;

class HomePageController extends Controller {

	/**
	 * Show Goodler Judge home page.
	 *
	 * @return Response homepage content
	 */
	public function index()
	{
		$problems = Problem::latest('created_at')->take(10)->get();
		$users = User::latest('created_at')->take(10)->get();

		return view('homepage', compact('problems','users'));
	}

}

