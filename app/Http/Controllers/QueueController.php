<?php namespace GoodlerJudge\Http\Controllers;

use GoodlerJudge\Http\Requests;
use GoodlerJudge\Http\Controllers\Controller;
use GoodlerJudge\Solution;

use Illuminate\Http\Request;

class QueueController extends Controller {
	/**
	 * Show Goodler Judge Queue page.
	 *
	 * @return \Illuminate\View\View
	 *
	 * TODO: Implement pagination.
	 */
	public function index()
	{
		$solutions = Solution::with('problem', 'user')
			->latest('created_at')->paginate(15);
		return view('queue', compact('solutions'));
	}

}
