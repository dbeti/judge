<?php namespace GoodlerJudge\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {

	/**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware = [
		'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
		'Illuminate\Cookie\Middleware\EncryptCookies',
		'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
		'Illuminate\Session\Middleware\StartSession',
		'Illuminate\View\Middleware\ShareErrorsFromSession',
		'GoodlerJudge\Http\Middleware\VerifyCsrfToken',
	];

	/**
	 * The application's route middleware.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
		'auth' =>
		    'GoodlerJudge\Http\Middleware\Authenticate',
		'auth.basic' =>
		    'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
		'guest' =>
		    'GoodlerJudge\Http\Middleware\RedirectIfAuthenticated',
		'owner_account' =>
		    'GoodlerJudge\Http\Middleware\RedirectIfNotOwnerAcc',
		'owner' =>
		    'GoodlerJudge\Http\Middleware\RedirectIfNotOwnProblem',
		'group_owner' =>
		    'GoodlerJudge\Http\Middleware\RedirectIfNotAGroupOwner',
		'group_member' =>
		    'GoodlerJudge\Http\Middleware\RedirectIfNotAGroupMember',
		'sol_owner' =>
		    'GoodlerJudge\Http\Middleware\RedirectIfNotASolutionOwner',
		'solve' =>
		    'GoodlerJudge\Http\Middleware\RedirectIfDidNotSolveAProblem'
	];

}
