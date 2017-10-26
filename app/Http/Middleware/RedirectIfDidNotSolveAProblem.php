<?php namespace GoodlerJudge\Http\Middleware;

use Closure;
use GoodlerJudge\Problem;
use GoodlerJudge\Solution;
use Illuminate\Support\Facades\Auth;

class RedirectIfDidNotSolveAProblem {

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
		if ($solution->user_id === Auth::user()->id) {
			return $next($request);
		}
		else if (Problem::findOrFail($request->segments()[1])
		                       ->solutions()
		                       ->where('status', '=', 'OK')
		                       ->where('user_id', '=', Auth::user()->id)
		                       ->get()
		                       ->isEmpty())
			return redirect('/problem/' .
			                $request->segments()[1] .
			                '/solution/create');

		return $next($request);
	}

}
