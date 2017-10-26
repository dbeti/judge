<?php namespace GoodlerJudge\Http\Middleware;

use Closure;
use GoodlerJudge\Solution;
use Illuminate\Auth\Guard;

class RedirectIfNotASolutionOwner {

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
		$solution = Solution::findOrFail($request->segments()[3]);
		if ($solution->user_id !== $this->auth->getUser()->id) {
			return redirect('/problem/' . $request->segments()[1] . '/solution');
		}

		return $next($request);
	}

}
