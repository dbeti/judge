<?php namespace GoodlerJudge\Http\Middleware;

use Closure;
use GoodlerJudge\Group;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;

class RedirectIfNotAGroupOwner {

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
		if (Group::findOrFail($request->segments()[1])->user_id !==
		        $this->auth->getUser()->id) {
			return redirect('/group');
		}
		return $next($request);
	}

}
