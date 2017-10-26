<?php namespace GoodlerJudge\TestEngine;

/**
 * TestResult class holds information about a finished test.
 */
class TestResult {

	/**
	 * @var int OK  Marks that test was sucessful.
	 * @var int WA  Marks wrong answer.
	 * @var int RTE Marks runtime error.
	 * @var int TLE Marks time limit exceeded error.
	 * @var int MLE Marks memory limit exceeded error.
	 */
	const OK = 0, WA = 1, RTE = 2, TLE = 3, MLE = 4;

	/**
	 * @var int Test status, one of OK, WA, RTE, TLE, MLE.
	 */
	public $status;

	/**
	 * @var float|null Total time taken.
	 */
	public $time;

	/**
	 * @var int|null Total memory taken in KB.
	 */
	public $memory;

	/**
	 * Create a new TestResult instance.
	 *
	 * @param int $status status of the test, one of OK, WA, RTE, TLE, MLE
	 * @param float|null $time total time taken
	 * @param int|null $memory total memory taken in KB
	 */
	public function __construct($status, $time = null, $memory = null)
	{
		$this->status = $status;
		$this->time = $time;
		$this->memory = $memory;
	}

}
