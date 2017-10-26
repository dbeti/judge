<?php namespace GoodlerJudge\Http\Middleware;

use Closure;
use GoodlerJudge\User;
use Illuminate\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotOwnerAcc {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard $auth
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$user = User::findOrFail($request->segments()[1]);

		if ($user->id !== $this->auth->getUser()->id) {
			return redirect('/user');
		}

		return $next($request);
	}
}
