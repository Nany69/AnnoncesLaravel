<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
    protected $fillable = array('role_id', 'password', 'username','email', 'confirmed', 'confirmation_code');

	public static $rules = array(
        'username' => 'required|alpha_num|unique:users',
        'email'=>'required|email|',
        'password'=>'required|alpha_num|between:2,12|confirmed',
        'password_confirmation'=>'required|alpha_num|between:2,12'
    );

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
	protected $hidden = array('password', 'remember_token');

}
