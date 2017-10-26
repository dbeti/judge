<?php namespace GoodlerJudge\TestEngine;

use \Symfony\Component\Process\Process;
use File;

/**
 * Compiler compiles a source file to a binary file.
 */
class Compiler {

	use UsesLXC;

	/**
	 * @var string PHP format string used to create compiler shell call.
	 */
	private $compilerTemplate;

	/**
	 * Create a new compiler.
	 *
	 * @param string $compilerTemplate PHP format string used to create
	 *    compiler shell call. It should use `%1$s` and `%2$s` to
	 *    denote source and output files respectively.
	 */
	public function __construct($compilerTemplate)
	{
		if ($compilerTemplate == '') {
			$this->compilerTemplate = '';
		} else {
			$this->compilerTemplate = $this->wrap($compilerTemplate);
		}
	}

	/**
	 * Compile source file.
	 *
	 * @param string $source source file
	 * @param string $output output file
	 *
	 * @return int error code
	 */
	public function compile($source, $output)
	{
		if ($this->compilerTemplate == '') {
			return $this->copyToContainer($source, $output);
		}

		$sourceName = $this->getFilename($source);
		$this->copyToContainer($source, $sourceName);

		$command = sprintf($this->compilerTemplate, $sourceName, $output);
		$status = (new Process($command))->run();

		$this->deleteFromContainer($sourceName);

		return $status;
	}

}

