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


	protected $fillable = array('nombre_usuario','email','password','rol');

	public function getTodayClients()
	{

	}

	public static function getList($filters)
	{
		$model = new self;
		return $model->_getList($filters);
	}

	public function getInputsForEdit()
	{
		$inputs[] = array("type" => 'common', 'data1' => 'Nombre', 'data2' => 'nombre_usuario', 'data3' => $this->nombre_usuario);
		$inputs[] = array("type" => 'common', 'data1' => 'Email', 'data2' => 'email', 'data3' => $this->email);
		$inputs[] = array("type" => 'select', 'data1' => 'Rol', 'data2' => 'rol', 'data3' => RolsDefinition::getDefinition(), 'data4' => $this->rol);
		$inputs[] = array("type" => 'common', 'data1' => 'Contraseña', 'data2' => 'password', 'data3' => '');
		/*$inputs[] = array("type" => 'hidden', 'data1' => 'habilitado', 'data2' => 0);
		$inputs[] = array("type" => 'checkbox', 'data1' => 'Habilitado', 'data2' => 'habilitado', 'data3' => 1,'data4' => $this->habilitado, 'data4' => $this->habilitado);*/
		return $inputs;
	}

	/**
	 * Listen for save event
	 */
	protected static function boot()
	{
		parent::boot();

		static::saving(function($model)
		{
			$model->password = Hash::make(Input::get('password'));
		});

		static::updating(function($model)
		{
			$model->password = Hash::make(Input::get('password'));
		});
	}


}
