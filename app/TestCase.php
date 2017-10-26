<?php namespace GoodlerJudge;

use Illuminate\Database\Eloquent\Model;

/**
 * Eloquent ORM for test_cases table.
 */
class TestCase extends Model {


	/**
	 * A Problem for which this is a test case.
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function problem()
	{
		return $this->belongsTo('GoodlerJudge\Problem');
	}

	/**
	 * Get storage directory for this test case.
	 *
	 * @return string
	 */
	public function getDirAttribute()
	{
		return 'test_cases/' . $this->problem->id . '/';
	}

	/**
	 * Get input filename of this test case.
	 *
	 * @return string
	 */
	public function getInputFileAttribute()
	{
		return "$this->id.in";
	}

	/**
	 * Get checker data for this test case.
	 *
	 * @return string
	 */
	public function getCheckerDataAttribute()
	{
		return "$this->id.out";
	}

}

