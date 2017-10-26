<?php namespace GoodlerJudge;

use Illuminate\Database\Eloquent\Model;

class ProgLang extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'compile_cmd',
		'run_cmd',
		'extension'
	];

	/**
	 * A programming language is used to create many solutions.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function solutions()
	{
		return $this->hasMany('GoodlerJudge\Solution');
	}

	/**
	 * Get the problems associated with the given language.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function problems()
	{
		return $this->belongsToMany('GoodlerJudge\Problem');
	}

}
