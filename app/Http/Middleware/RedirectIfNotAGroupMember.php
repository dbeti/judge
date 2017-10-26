<?php namespace GoodlerJudge\Http\Middleware;

use Closure;
use GoodlerJudge\Group;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAGroupMember {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (!Group::findOrFail($request->segments()[1])
		                               ->users->keyBy('id')
		                               ->has(Auth::user()->id)) {
			return redirect('/group');
		}
		return $next($request);
	}

}
