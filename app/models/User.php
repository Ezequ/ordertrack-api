<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Model implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $table = 'users';
	public $timestamps = false;
	protected $hidden = array('password');
	protected $allowedFilters = array('email', 'nombre_usuario','rol');


	protected $fillable = array('nombre_usuario','email','password', '');

	public function getTodayClients()
	{

	}

	public static function getList($filters)
	{
		$model = new self;
		return $model->_getList($filters);
	}

}
