<?php namespace GoodlerJudge\Http\Controllers;

use GoodlerJudge\Http\Requests;
use GoodlerJudge\Http\Controllers\Controller;

use GoodlerJudge\Http\Requests\EditUserAccRequest;
use GoodlerJudge\Http\Requests\UserRequest;
use GoodlerJudge\Solution;
use GoodlerJudge\User;
use Illuminate\Http\Request;

class UserController extends Controller {

	/**
	 * Middleware.
	 */
	public function __construct()
	{
		$this->middleware('auth', ['only' => ['edit', 'update']]);
		$this->middleware('owner_account', ['only' => ['edit', 'update']]);
	}

	/**
	 * Show users.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		$users = User::latest('created_at')->paginate(15);

		return view('users.index', compact('users'));
	}

	/**
	 * Show specific user account
	 *
	 * @param User $user
	 * @return \Illuminate\View\View
	 */
	public function show(User $user)
	{
		$OKSolutions = Solution::solved($user->id)
		                       ->orderBy('id', 'desc')
		                       ->groupBy('problem_id')
		                       ->paginate(10);

		$notOKSolutions = Solution::unsolved($user->id)
		                       ->orderBy('id', 'desc')
			                   ->groupBy('problem_id')
		                       ->whereNotIn('problem_id', $OKSolutions
		                                    ->lists('problem_id'))
		                       ->paginate(10);
		return view('users.show', compact('user',
		                                  'OKSolutions',
		                                  'notOKSolutions'));
	}

	/**
	 * Show edit account to authorized user
	 *
	 * @param User $user
	 * @return \Illuminate\View\View
	 * @internal param EditUserAccRequest $request
	 */
	public function edit(User $user)
	{
		return view('users.edit', compact('user'));
	}

	/**
	 * Update user account information.
	 *
	 * @param User $user
	 * @param UserRequest $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function update(User $user, UserRequest $request)
	{
		$user->update($request->all());

		return redirect('/user');
	}
}
