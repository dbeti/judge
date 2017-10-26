<?php
/*
 * NOTE: This example requires laravel to be bootstraped -- you can use
 *       artisan tinker to run the following commands
 */

// First we create a checker that checks solution correctenss
$checker = new \GoodlerJudge\TestEngine\Checker( // create a checker
	'app/TestEngine/example/words_checker.c',    // checker source code
	'gcc -o %2$s %1$s',                          // compiler command
	'./%1$s');                                   // run command
$checker->compile();   //compile the checker

// Using the checker we create a TestEngine
$engine = new \GoodlerJudge\TestEngine\TestEngine(
	'app/TestEngine/example/sum_correct.c',     // solution source code
	'gcc -o %2$s %1$s',                         // compile command
	'./%1$s',                                   // run command
	1,                                          // 1s time limit
	16*1024,                                    // 16MB memory limit
	$checker);                                  // checker to use
$engine->compile();    //compile solution

// Now we can run tests using our TestEngine:
$engine->test(
	'app/TestEngine/example/test.in.1',               // solution input
	'app/TestEngine/example/test.out.1'               // correct solution data
)->status == \GoodlerJudge\TestEngine\TestResult::OK; // should be equal

// Try changing `sum_correct.c` to `sum_wrong.c`, `too_long.c`, `memory.c` or
// `zero_div.c` and see what happens.

