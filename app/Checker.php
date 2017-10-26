<?php namespace GoodlerJudge;

use Illuminate\Database\Eloquent\Model;

class Checker extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'prog_lang_id',
		'name'
	];

	/**
	 * Default attribute values.
	 */
	protected $attributes = [
		'shared' => false,
	];

	/**
	 * Problems which the checker evaluates.
	 *
	 * @return Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function problems()
	{
		return $this->hasMany('GoodlerJudge\Problem');
	}


	/**
	 * Language in which the checker is written.
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function prog_lang()
	{
		return $this->belongsTo('GoodlerJudge\ProgLang');
	}

	/**
	 * A User that created the checker.
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('GoodlerJudge\User');
	}

	/**
	 * Get storage directory for this Checkers source.
	 *
	 * @return string
	 */
	public function getSourceDirAttribute()
	{
		return "checkers/";
	}

	/**
	 * Get filename of this Checkers source.
	 *
	 * @return string
	 */
	public function getSourceNameAttribute()
	{
		$extension = $this->prog_lang->extension;
		return "$this->id.$extension";
	}
}
