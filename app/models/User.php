<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {
	
	protected $fillable = array('name', 'email', 'password', 'date_of_birth', 'month_of_birth', 'year_of_birth', 'present_address', 'permanent_address', 'designation', 'gender', 'token', 'active', 'referal_id', 'arrange_group', 'type');

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password'); // , 'remember_token'
    
    public function cart()
    {
        return $this->hasMany('Cart');
    }
    
    public function points()
    {
        return $this->hasMany("Point");
    }

    public function amounts()
    {
        return $this->hasMany("Amount", "user_id", "id");
    }

    public function notices()
    {
        return $this->hasMany('Notice', 'id', 'user_id');
    }

}
