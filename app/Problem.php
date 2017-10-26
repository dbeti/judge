<?php namespace GoodlerJudge;

use Illuminate\Database\Eloquent\Model;

/**
 * Eloquent ORM model for problems table.
 */
class Problem extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'description',
		'time_limit',
		'memory_limit',
		'checker_id'
	];

	/**
	 * Problem belongs to user.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('GoodlerJudge\User');
	}

	/**
	 * A problem has many solutions.
	 *
	 * @return Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function solutions()
	{
		return $this->hasMany('GoodlerJudge\Solution');
	}

	/**
	 * Get the groups associated with the given problem.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function groups()
	{
		return $this->belongsToMany('GoodlerJudge\Group');
	}

	/**
	 * Get the languages associated with the given problem.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function prog_langs()
	{
		return $this->belongsToMany('GoodlerJudge\ProgLang');
	}

	/**
	 * Get the tags associated with the given problem.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function tags()
	{
		return $this->belongsToMany('GoodlerJudge\Tag');
	}

	/**
	 * Get a list of tag ids associated with the current problem.
	 *
	 * @return mixed
	 */
	public function getTagListAttribute()
	{
		return $this->tags->lists('id');
	}

	/**
	 * Checker used for checking solutions.
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function checker()
	{
		return $this->belongsTo('GoodlerJudge\Checker');
	}

	/**
	 * Test cases for this problem.
	 */
	public function test_cases() {
		return $this->hasMany('GoodlerJudge\TestCase');
	}
}

