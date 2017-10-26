<?php namespace GoodlerJudge\TestEngine;

use \Symfony\Component\Process\Process;
use \Carbon\Carbon;

/**
 * TestCase can run a test case on a program.
 */
class TestCase {

	use UsesLXC;

	/**
	 * @var string File containing test data.
	 */
	private $testData;

	/**
	 * @var string File containing correct data used by the checker.
	 */
	private $correctData;

	/**
	 * @var Checker A checker instance for checking correctenss of solutions.
	 */
	private $checker;

	/**
	 * @var int|float Test case time limit.
	 */
	private $timeLimit;

	/**
	 * @var int Test case memory limit in KB.
	 */
	private $memoryLimit;

	/**
	 * Create a new TestCase instance.
	 *
	 * @param string $testData file containing test data
	 * @param string $correctData file containing correct data use by the
	 *    checker
	 * @param int|float $timeLimit test case time limit
	 * @param int $memoryLimit test case memory limit in KB
	 * @param Checker $checker a checker instance
	 */
	public function __construct($testData, $correctData, $timeLimit,
	                            $memoryLimit, $checker)
	{
		$this->testData = $testData;
		$this->correctData = $correctData;
		$this->timeLimit = $timeLimit;
		$this->memoryLimit = $memoryLimit;
		$this->checker = $checker;
	}

	/**
	 * Run the test case on solution.
	 *
	 * @param string $runCommand command to run solution
	 *
	 * @return TestResult
	 */
	public function testOn($runCommand)
	{
		$outfile = Carbon::now()->format('Y-m-d-h-i-s') . '.out';
		$runCmd = $this->wrap("$runCommand < $this->testData > $outfile");
		$process = new Process($runCmd);
		$status = TestResult::OK;
		$time = .0;
		$memory = 0;

		$process->start();
		$start = microtime(true);
		$pid = $this->getPid($runCommand);

		while(!$process->isTerminated()) {
			$memory = max($memory, $this->getMemoryUsage($pid));
			if ($memory > $this->memoryLimit) {
				$status = TestResult::MLE;
				break;
			}
			if (!$process->isRunning()) {
				if (!$process->isSuccessful()) {
					$status = TestResult::RTE;
				}
				break;
			}
			$time = microtime(true) - $start;
			if ($time >= $this->timeLimit) {
				$status = TestResult::TLE;
				break;
			}
			usleep(10000);
		}

		if (!$process->isTerminated()) {
			$process->stop(0);
			$this->containerKill($runCommand);
		}

		if ($status == TestResult::OK && !$process->isSuccessful()) {
			$status = TestResult::RTE;
		}

		if ($status == TestResult::OK &&
				$this->checker->check($outfile, $this->correctData) != 0) {
			$status = TestResult::WA;
		}

		$this->deleteFile($outfile);

		return new TestResult($status, $time, $memory);
	}

	/**
	 * Deletes a file from filesystem.
	 *
	 * @param string filename
	 *
	 * @return int exit code
	 */
	private function deleteFile($filename)
	{
		return (new Process("rm $filename"))->run();
	}
}

