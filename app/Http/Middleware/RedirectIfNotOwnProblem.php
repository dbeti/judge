<?php namespace GoodlerJudge\Http\Middleware;

use Closure;
use GoodlerJudge\Problem;
use Illuminate\Auth\Guard;

class RedirectIfNotOwnProblem {

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
		$problem = Problem::findOrFail($request->segments()[1]);

		if ($problem->user_id !== $this->auth->getUser()->id) {
			return redirect('/problem');
		}

		return $next($request);
	}

}
