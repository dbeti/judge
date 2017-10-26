<?php namespace GoodlerJudge;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
		CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
		'username'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	 * Problems created by the user.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function problems()
	{
		return $this->hasMany('GoodlerJudge\Problem');
	}

	/**
	 * Get the groups associated with the given user.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function groups()
	{
		return $this->belongsToMany('GoodlerJudge\Group');
	}

	/**
	 * Checkers created by the user.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function checkers()
	{
		return $this->hasMany('GoodlerJudge\Checker');
	}

	/**
	 * Solutions submited by the user.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function solutions()
	{
		return $this->hasMany('GoodlerJudge\Solution');
	}

}
