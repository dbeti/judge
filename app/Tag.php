<?php namespace GoodlerJudge;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'description'
	];

	/**
	 * Get the problems associated with the given tag.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function problems()
	{
		return $this->belongsToMany('GoodlerJudge\Problem');
	}
}
