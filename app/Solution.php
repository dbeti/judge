<?php namespace GoodlerJudge;

use Storage;

use Illuminate\Database\Eloquent\Model;

/**
 * Eloquent ORM model for solutions table.
 */
class Solution extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'problem_id',
		'prog_lang_id',
	];

	/**
	 * Default attribute values.
	 * @var array
	 */
	protected $attributes = [
		'status' => '-',
	];

	/**
	 * Get solution source directory.
	 *
	 * @return string
	 */
	public function getSourceDirAttribute()
	{
		return "solutions/$this->problem_id/";
	}

	/**
	 * Get solution source filename.
	 *
	 * @return string
	 */
	public function getSourceNameAttribute()
	{
		$extension = $this->prog_lang->extension;
		return "$this->id.$extension";
	}

	/**
	 * Get solution source code.
	 *
	 * @param string
	 */
	public function getSourceCodeAttribute()
	{
		return Storage::disk('local')->get(
			$this->source_dir . $this->source_name);
	}

	/**
	 * Language in which the solution is written.
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function prog_lang()
	{
		return $this->belongsTo('GoodlerJudge\ProgLang');
	}

	/**
	 * Get the problem this is a solution of.
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function problem()
	{
		return $this->belongsTo('GoodlerJudge\Problem');
	}

	/**
	 * Get the author of this soluion.
	 *
	 * @return Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('GoodlerJudge\User');
	}

	/**
	 * Get solved solutions with status OK associated with the given user.
	 *
	 * @param $query
	 * @param $user_id
	 * @return mixed
	 */
	public function scopeSolved($query, $user_id)
	{
		return $query->where('status', '=' , 'OK')
		             ->where('user_id', '=' , $user_id);
	}

	/**
	 * Get unsolved solutions with status OK associated with the given user.
	 *
	 * @param $query
	 * @param $user_id
	 * @return mixed
	 */
	public function scopeUnsolved($query, $user_id)
	{
		return $query->where('status', '!=' , 'OK')
		             ->where('user_id', '=' , $user_id);
	}
}
