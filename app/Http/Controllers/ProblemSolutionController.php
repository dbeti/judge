<?php namespace GoodlerJudge\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Request as Req;
use Queue;
use Storage;
use File;
use Auth;

use GoodlerJudge\Http\Requests;
use GoodlerJudge\Http\Requests\StoreProblemSolutionRequest;
use GoodlerJudge\Http\Controllers\Controller;
use GoodlerJudge\Commands\EvaluateSolution;
use GoodlerJudge\Problem;
use GoodlerJudge\ProgLang;
use GoodlerJudge\Solution;

use Illuminate\Http\Request;

/**
 * Handles solution submitting and viewing.
 */
class ProblemSolutionController extends Controller {

	/**
	 * Create a new ProblemSolutionController instance.
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('solve', ['only' => ['show']]);
	}

	/**
	 * Display a list of solutions to the problem.
	 *
	 * @param Problem $problem
	 *
	 * @return Response
	 */
	public function index(Problem $problem)
	{
		$solutions = $problem->solutions()->with('user')
		                     ->where('status', '=', 'OK')
		                     ->orderBy('total_time', 'asc')->paginate(15);

		return view('problems.solutions.index',
		             compact('problem', 'solutions'));
	}

	/**
	 * Show the form for submmiting a new solution.
	 *
	 * @param Problem $problem
	 *
	 * @return Response
	 */
	public function create(Problem $problem)
	{
		$langs = ProgLang::lists('name', 'id');
		return view('problems.solutions.create', compact('problem', 'langs'));
	}

	/**
	 * Submit solution.
	 *
	 * @param Problem $problem
	 * @param StoreProblemSolutionRequest $request
	 *
	 * @return Response
	 */
	public function store(
		Problem $problem,
		StoreProblemSolutionRequest $request)
	{
		$solution = Auth::user()->solutions()->save(
			$this->createSolutionEntry($problem, $request));

		$request->file('source')->move(
			storage_path() . '/app/' . $solution->source_dir,
			$solution->source_name);

		Queue::push(new EvaluateSolution($solution));

		return redirect()->action('QueueController@index');
	}

	/**
	 * Display the specified solution.
	 *
	 * @param Problem $problem
	 * @param Solution $solution
	 *
	 * @return Response
	 */
	public function show(Problem $problem, Solution $solution)
	{
		return view('problems.solutions.show',
			compact('problem', 'solution'));
	}

	/**
	 * Create a solution eloquent model using the given request and problem.
	 *
	 * @param StoreProblemSolutionRequest $request
	 * @param Problem $problem
	 *
	 * @return Solution
	 */
	private function createSolutionEntry(
		Problem $problem,
		StoreProblemSolutionRequest $request)
	{
		$solution = new Solution;
		$solution->prog_lang_id = $request->language;
		$solution->problem_id = $problem->id;
		return $solution;
	}
}
