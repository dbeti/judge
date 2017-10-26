<?php namespace GoodlerJudge\Http\Controllers;

use GoodlerJudge\Http\Requests;
use GoodlerJudge\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request as Req;
use GoodlerJudge\Problem;
use GoodlerJudge\User;
use Illuminate\Http\Request;

class ProblemUserSolutionController extends Controller {

	/**
	 * Create a new ProblemUserSolutionController instance.
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Problem $problem, User $user)
	{
		if (Req::query('unsolved') !== null) {
			$solutions = $problem->solutions()
			                     ->unsolved($user->id)
			                     ->orderBy('id', 'desc')
			                     ->paginate(15);
		} else {
			$solutions = $problem->solutions()
			                     ->solved($user->id)
			                     ->orderBy('id', 'desc')
			                     ->paginate(15);
		}
		return view('problems.users.solutions.index',
		            compact('user', 'problem', 'solutions'));
	}

}
