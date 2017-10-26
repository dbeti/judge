<?php namespace GoodlerJudge\TestEngine;

use Carbon\Carbon;
use File;
use \Symfony\Component\Process\Process;

/**
 * Wraps compilation and calls of solution checker.
 */
class Checker {

	use UsesLXC;

	/**
	 * @var string Checker source file.
	 */
	private $source;

	/**
	 * @var string Checker binary file.
	 */
	private $binary;

	/**
	 * @var Compiler Compiler used for compiling the checker.
	 */
	private $compiler;

	/**
	 * @var string Shell command for runing the checker.
	 */
	private $runCommand;

	/**
	 * Create a new Checker instance.
	 *
	 * @param string $source checker source file
	 * @param string $compilerTemplate template passed to Compiler constructor
	 * @param string $runTemplate shell command template for runing the
	 *    checker, %s denotes checker name
	 *
	 * @see Compiler
	 */
	public function __construct($source, $compilerTemplate, $runTemplate)
	{
		$this->source = $source;
		$this->compiler = new Compiler($compilerTemplate);
		$this->binary = 'checker-' . Carbon::now()->format('Y-m-d-h-i-s');
		$this->runCommand = sprintf($runTemplate, $this->binary);
	}

	/**
	 * Compile the checker.
	 *
	 * @return int error code
	 */
	public function compile()
	{
		return $this->compiler->compile($this->source, $this->binary);
	}


	/**
	 * Check solution with checker.
	 *
	 * @param string $solution solution result file
	 * @param string $correct correct solution passed to the checker
	 */
	public function check($solution, $correct)
	{
		$solName = 'sol-'.Carbon::now()->format('Y-m-d-h-i-s');
		$cctName = 'cct-'.Carbon::now()->format('Y-m-d-h-i-s');
		$this->copyToContainer($solution, $solName);
		$this->copyToContainer($correct, $cctName);

		$checkCmd = $this->wrap("$this->runCommand $solName $cctName");
		$status = (new Process($checkCmd))->run();

		$this->deleteFromContainer($solName);
		$this->deleteFromContainer($cctName);

		return $status;
	}

	/**
	 * Destroy the checker.
	 */
	public function __destruct()
	{
		$this->deleteFromContainer($this->binary);
	}

}

