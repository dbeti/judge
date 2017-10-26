<?php namespace GoodlerJudge;

use Illuminate\Database\Eloquent\Model;

class Group extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name'
	];

	/**
	 * A group belongs to a user.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('GoodlerJudge\User');
	}

	/**
	 * Get the users associated with the given group.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function users()
	{
		return $this->belongsToMany('GoodlerJudge\User');
	}

	/**
	 * Get the problems associated with the given group.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function problems()
	{
		return $this->belongsToMany('GoodlerJudge\Problem');
	}

	/**
	 * Get a list of user ids associated with the current group.
	 *
	 * @return array
	 */
	public function getUserListAttribute()
	{
		return $this->users->lists('id');
	}

	public function getProblemListAttribute()
	{
		return $this->problems->lists('id');
	}
}
