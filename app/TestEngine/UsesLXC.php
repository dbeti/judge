<?php namespace GoodlerJudge\TestEngine;

use \Symfony\Component\Process\Process;
use File;

/**
 * Provides LXC utility functions.
 */
trait UsesLXC {

	/**
	 * Wraps a command in lxc-attach call.
	 *
	 * @param string $command
	 *
	 * @return string command wraped in lxc-attach
	 */
	private function wrap($command)
	{
		return env('LXC_PREFIX', '') . ' ' . $command;
	}

	/**
	 * Copy file from file system to LXC container.
	 *
	 * @param string $from
	 * @param string $to
	 *
	 * @return void
	 */
	private function copyToContainer($from, $to)
	{
		$copyCmd = $this->wrap("tee $to < $from > /dev/null");
		return (new Process($copyCmd))->run();
	}

	/**
	 * Delete file from LXC container.
	 *
	 * @param string $filename
	 *
	 * @return void
	 */
	private function deleteFromContainer($filename)
	{
		$deleteCmd = $this->wrap("rm $filename");
		return (new Process($deleteCmd)) -> run();
	}

	/**
	 * Get filename from path
	 *
	 * @param string $path
	 *
	 * @return string file name
	 */
	private function getFilename($path)
	{
		$ext = File::extension($path);
		if ($ext == '') {
			return File::name($path);
		} else {
			return File::name($path) . '.' . $ext;
		}
	}

	/**
	 * Kill a process (or processes) runing in container
	 *
	 * @param string $needle part of the process name
	 *
	 * @return int exit status
	 */
	private function containerKill($needle)
	{
		$status = 0;
		$output = [];
		exec($this->wrap('pkill -f ' . $needle), $output, $status);
		return $status;
	}

	/**
	 * Get PID of commands process.
	 *
	 * @param string $command command which started the process
	 *
	 * @return null|int PID if process exists, null otherwise
	 */
	private function getPid($command)
	{
		$process = new Process($this->wrap("pgrep -f $command"));
		if ($process->run() == 0) {
			return intval($process->getOutput());
		} else {
			return null;
		}
	}

	/**
	 * Get current memory usage of process with given PID.
	 *
	 * @param int $pid
	 *
	 * @return null|int memory in KB if given PID exists, null otherwise
	 */
	private function getMemoryUsage($pid)
	{
		$command = "pmap $pid | grep total | grep -o '[0-9]*'";
		$process = new Process($this->wrap($command));
		if ($process->run() == 0) {
			return intval($process->getOutput());
		} else {
			return null;
		}
	}
}

