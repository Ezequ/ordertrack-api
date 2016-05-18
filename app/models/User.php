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

	public static $rules = array(
		'nombre_usuario'    => 'required',
		'email'             => 'required|email|unique:users,email,{self::id}',
		'password' 			=> 'sometimes|min:6',
		'rol'               => 'not_in:0',
	);


	protected $fillable = array('nombre_usuario','email','password','rol');

	public static $messages = array(
		'not_in'			=> 'El rol seleccionado es inválido.',
		'integer'			=> 'El valor del :atribute debe ser un entero',
		'required'      => 'El campo :attribute es requerido.',
		'password.min'	=> 'La contraseña debe tener al menos 6 dígitos',
		'email.unique'  => 'Ya existe un usuario con ese email.',
		'email.email'	=> 'El formato de email es incorrecto.'
	);



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
			if(Input::get('password'))
			$model->password = Hash::make(Input::get('password'));
		});

		static::updating(function($model)
		{
			if(Input::get('password'))
			$model->password = Hash::make(Input::get('password'));
		});
	}

	public function hasAccess($allowedRols, $action = "")
	{
		$rolHasAccess = in_array($this->rol,explode(",",$allowedRols));
		$rolHasAccessToAction = !($this->isSeller() && ($action == "crear" || $action == "editar" ||
								$action == "borrar" || $action == "delete" || $action == "changeStatus"));
		return $rolHasAccess && $rolHasAccessToAction;
	}

	public function isSeller()
	{
		return $this->rol == RolsDefinition::SELLER;
	}


}
