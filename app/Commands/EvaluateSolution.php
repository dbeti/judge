<?php namespace GoodlerJudge\Commands;

use GoodlerJudge\Commands\Command;
use GoodlerJudge\TestEngine\Checker;
use GoodlerJudge\TestEngine\TestEngine;
use GoodlerJudge\TestEngine\TestResult;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

/**
 * Runs tests on a problem solution.
 */
class EvaluateSolution extends Command
		implements SelfHandling, ShouldBeQueued {

	use InteractsWithQueue, SerializesModels;

	/**
	 * @var GoodlerJudge\Solution Solution instance beeing evaluated.
	 */
	private $solution;

	/**
	 * Create a new EvaluateSolution instance.
	 *
	 * @param GoodlerJudge\Solution $solution solution instance beeing
	 *    evaluated
	 *
	 * @return void
	 */
	public function __construct($solution)
	{
		$this->solution = $solution;
	}

	/**
	 * Evaluate solution.
	 *
	 * @return void
	 */
	public function handle()
	{
		$sp = storage_path();
		$solution = $this->solution;
		$problem = $solution->problem;
		$checkerModel = $solution->checker;

		$status = "OK";
		$maxMemory = null;
		$totalTime = null;

		$statusMapping = [
			TestResult::WA => "WA",
			TestResult::RTE => "RTE",
			TestResult::TLE => "TLE",
			TestResult::MLE => "MLE",
		];

		try {
			// create a test engine
			$engine = $this->getTestEngine(
				$this->solution,
				$this->solution->problem,
				$this->solution->problem->checker
			);

			$totalTime = 0;

			// run tests on solution
			foreach ($this->solution->problem->test_cases as $testCase) {
				$testResult = $engine->test(
						"$sp/app/$testCase->dir$testCase->input_file",
						"$sp/app/$testCase->dir$testCase->checker_data");

				$maxMemory = max($maxMemory, $testResult->memory);
				$totalTime += $testResult->time;

				if ($testResult->status != TestResult::OK) {
					$status = $statusMapping[$testResult->status];
					break;
				}
			}

		} catch (\RuntimeException $e) {
			$status = $e->getMessage();
		}

		$solution->status = $status;
		$solution->total_time = $totalTime;
		$solution->max_memory = $maxMemory;
		$solution->save();
	}

	/**
	 * Get a TestEngine instance for submitted solution.
	 *
	 * @param Solution $solution
	 * @param Problem $problem
	 * @param Checker $checkerModel
	 *
	 * @return TestEngine
	 */
	private function getTestEngine($solution, $problem, $checkerModel)
	{
		$sp = storage_path();

		// First, we create and compile the checker for this problem
		$checker = new Checker(

			"$sp/app/$checkerModel->source_dir$checkerModel->sourceName",
			$checkerModel->prog_lang->compile_cmd,
			$checkerModel->prog_lang->run_cmd);
		if ($checker->compile() != 0) throw new \RuntimeException('CCE');

		// Then we create and compile the engine
		$engine = new TestEngine(
			"$sp/app/$solution->source_dir$solution->source_name",
			$solution->prog_lang->compile_cmd,
			$solution->prog_lang->run_cmd,
			$problem->time_limit,
			$problem->memory_limit * 1024,
			$checker);
		if ($engine->compile() != 0) throw new \RuntimeException('CE');

		return $engine;
	}
}

