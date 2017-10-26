<?php namespace GoodlerJudge\Http\Controllers;

use Carbon\Carbon;
use GoodlerJudge\Http\Requests;
use GoodlerJudge\Http\Controllers\Controller;
use GoodlerJudge\Http\Requests\ProblemRequest;
use GoodlerJudge\Problem;

use GoodlerJudge\User;
use GoodlerJudge\ProgLang;
use GoodlerJudge\Checker;
use GoodlerJudge\Tag;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ProblemController extends Controller {

	public function __construct()
	{
		$this->middleware('auth', ['except' => ['index', 'show']]);
		$this->middleware('owner', [
			'except' => ['index', 'show', 'create', 'store']
		]);
	}

	/**
	 * Show Goodler Judge problem list.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		/* Get latest problems first */
		$problems = Problem::latest('created_at')->paginate(15);

		return view('problems.index', compact('problems'));
	}

	/**
	 * Create new problem
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		$tags = Tag::lists('name','id');

		/* Only user checkers */
		$checkers = Checker::lists('name', 'id');

		return view('problems.create', compact('tags','checkers'));
	}

	/**
	 * Store new problem
	 *
	 * @param ProblemRequest $request
	 * @return mixed
	 */
	public function store(ProblemRequest $request)
	{

		$problem = new Problem($request->all());
		Auth::user()->problems()->save($problem);

		/*Tags*/
		$this->syncTags($request,$problem);


		return redirect('/problem');
	}

	/**
	 * Show specific problem.
	 *
	 * @param Problem $problem
	 * @return mixed
	 */
	public function show(Problem $problem)
	{
		return view('problems.show', compact('problem'));
	}

	/**
	 * Edit specific problem.
	 *
	 * @param Problem $problem
	 * @return \Illuminate\View\View
	 */
	public function edit(Problem $problem)
	{
		$tags = Tag::lists('name','id');
		$checkers = Checker::lists('name','id');

		return view('problems.edit', compact('problem','tags','checkers'));
	}

	/**
	 * Update specific problem.
	 *
	 * @param Problem $problem
	 * @param ProblemRequest $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function update(Problem $problem, ProblemRequest $request)
	{
		$problem->update($request->all());

		$this->syncTags($request, $problem);

		return redirect('/problem');
	}

	/**
	 * Delete a problem.
	 *
	 * @param Problem $problem
	 *
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function destroy(Problem $problem)
	{
		$problem->delete();

		return redirect('/problem');
	}

	/**
	 * Sync tags and add new.
	 *
	 * @param ProblemRequest $request
	 * @param Problem $problem
	 */
	public function syncTags(ProblemRequest $request, Problem $problem)
	{
		$allTagIds = array();

		foreach ($request->tag_list as $tagId) {
			if (strlen($tagId) > 4) {
				if (substr($tagId, 0, 4) == 'new:') /*add new tag*/ {
					$tagString = substr($tagId, 4); /*full string */

					/* find description between brackets */
					if (preg_match('!\(([^\)]+)\)!', $tagString, $match))
						$desc = ($match[1]);
					else
						$desc = "no description";

					$desc1 = "(" . $desc . ")";
					$name = str_replace($desc1, "", $tagString);

					$newTag = Tag::create(['name' => $name, 'description' =>
						$desc]);
					$allTagIds[] = $newTag->id;
					continue;
				}
				$allTagIds[] = $tagId;
			}
		}

		$problem->tags()->sync($allTagIds);
	}

}
