<?php namespace GoodlerJudge\Http\Controllers;

use GoodlerJudge\Checker;
use GoodlerJudge\Http\Requests;
use GoodlerJudge\Http\Controllers\Controller;

use GoodlerJudge\Http\Requests\CheckerRequest;
use GoodlerJudge\ProgLang;
/*use Illuminate\Http\Request;*/
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Symfony\Component\Filesystem\Filesystem;

class CheckerController extends Controller {

	/* Constructor */
	public function __construct()
	{
		$this->middleware('auth', ['only' => ['create', 'store']]);
	}

	/**
	 * Show checker create page
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		$programLang = ProgLang::lists('name','id');

		return view('problems.checker', compact('programLang'));
	}

	/**
	 * Store checker.
	 *
	 * @param CheckerRequest $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function store(CheckerRequest $request)
	{
		$checker = new Checker($request->all());

		$checker->prog_lang_id = $request->prog_lang;

		Auth::user()->checkers()->save($checker);

		$request->file('file')->move(
			storage_path() . "/app/$checker->source_dir",$checker->source_name
		);

		return redirect('/problem/create');
	}
}
