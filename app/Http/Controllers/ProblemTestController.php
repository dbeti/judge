<?php namespace GoodlerJudge\Http\Controllers;

use GoodlerJudge\Http\Requests;
use GoodlerJudge\Http\Controllers\Controller;

use GoodlerJudge\Http\Requests\StoreProblemTestRequest;
use GoodlerJudge\Problem;
use GoodlerJudge\TestCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProblemTestController extends Controller {
	/**
	 * Create a new ProblemTestController instance.
	 *
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('owner');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param Problem $problem
	 * @return Response
	 */
	public function index(Problem $problem)
	{
		return view('problems.tests.index', compact('problem'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param Problem $problem
	 * @return Response
	 */
	public function create(Problem $problem)
	{
		return view('problems.tests.create', compact('problem'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Problem $problem
	 * @param StoreProblemTestRequest $request
	 * @return Response
	 */
	public function store(Problem $problem,
						  StoreProblemTestRequest $request)
	{
		$test = new TestCase;

		$test['problem_id'] = $problem->id;

		$test->save();

		$request->file('test_input')->move(
			storage_path() . "/app/".$test->getDirAttribute(),
			$test->getInputFileAttribute());

		$request->file('test_output')->move(
			storage_path() . "/app/".$test->getDirAttribute(),
			$test->getCheckerDataAttribute());

		return redirect()->action('ProblemController@show', compact('problem'))
			             ->with('message', 'Successful created test');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param Problem $problem
	 * @param TestCase $test
	 * @return Response
	 * @internal param TestCase $problem
	 * @internal param int $id
	 */
	public function show(Problem $problem, TestCase $test)
	{

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param Problem $problem
	 * @param Test|TestCase $test
	 * @return Response
	 * @internal param int $id
	 */
	public function destroy(Problem $problem, TestCase $test)
	{
		/* Delete files */
		Storage::delete($test->getDirAttribute().
			            $test->getInputFileAttribute());
		Storage::delete($test->getDirAttribute().
			            $test->getCheckerDataAttribute());

		$test->delete();

		return redirect("/problem/".$problem->id."/test/");
	}

	/**
	 * Download a test file.
	 *
	 * @param Problem $problem
	 * @param TestCase $test
	 * @param $id
	 * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
	 *
	 */
	public function download(Problem $problem, TestCase $test, $id)
	{

		$file = storage_path('app') . '/' . $test->getDirAttribute().'/';

	if($id == 1)
		$file = $file.$test->getInputFileAttribute();
	else
		$file = $file.$test->getCheckerDataAttribute();

	return response()->download($file);
	}

}
