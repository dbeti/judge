<?php namespace GoodlerJudge\TestEngine;

use \Carbon\Carbon;

/**
 * TestEngine can compile and test submission on a series of tests.
 */

class TestEngine {

	use UsesLXC;

	/**
	 * @var string Name of file containing solution source.
	 */
	private $sourceFile;

	/**
	 * @var Compiler Compiler used to compile solutions.
	 */
	private $compiler;

	/**
	 * @var string Compiled solution filename.
	 */
	private $binary;

	/**
	 * @var Checker A checker instance for this engine.
	 */
	private $checker;

	/**
	 * @var string Shell command that runs solution.
	 */
	private $runCommand;

	/**
	 * @var int|float Solution time limit.
	 */
	private $timeLimit;

	/**
	 * @var int Solution memory limit in KB.
	 */
	private $memoryLimit;

	/**
	 * Create a new TestEngine instance.
	 *
	 * @param string $sourceFile name of file containing solution source
	 * @param string $compilerTemplate template passed to Compiler constructor
	 * @param string $runTemplate shell command template that runs solution,
	 *    %1$s denotes program name
	 * @param int|float $timeLimit solution time limit
	 * @param int $memoryLimit solution memory limit in KB
	 * @param Checker $checker a checker instance for this engine
	 *
	 * @see Compiler
	 * @see Checker
	 */
	public function __construct($sourceFile, $compilerTemplate, $runTemplate,
	                            $timeLimit, $memoryLimit, $checker)
	{
		$this->sourceFile = $sourceFile;
		$this->compiler = new Compiler($compilerTemplate);
		$this->binary = 'bin-' . Carbon::now()->format('Y-m-d-h-i-s');
		$this->runCommand = sprintf($runTemplate, $this->binary);
		$this->timeLimit = $timeLimit;
		$this->memoryLimit = $memoryLimit;
		$this->checker = $checker;
	}

	/**
	 * Compile submission.
	 *
	 * @return int error code
	 */
	public function compile()
	{
		return $this->compiler
					->compile($this->sourceFile, $this->binary);
	}

	/**
	 * Run a single test.
	 *
	 * @param string $testData File containing test data. It will be passed
	 *    to STDIN.
	 * @param string $correct File containing correct result used by the
	 *    checker.
	 *
	 * @return TestResult
	 */
	public function test($testData, $correct)
	{
		return (new TestCase($testData, $correct, $this->timeLimit,
							 $this->memoryLimit, $this->checker))
				->testOn($this->runCommand);
	}

	/**
	 * Clean up after running tests.
	 *
	 * @return void
	 */
	public function clean()
	{
		$this->deleteFromContainer($this->binary);
	}

	/**
	 * Destroy TestEngine instance.
	 *
	 * Automatically cleans up taken resources.
	 */
	public function __destruct() {
		$this->clean();
	}
}

