<?php /**
* 
*/
class UsuarioControllerAdm extends AdminController
{
	public $name = "usuario";

	public function getListado()
	{
		/* nombre acciones habilitadas*/
		$buttons = array('editar' => null, 'borrar' => null);
		/* nombre => campo en base de datos	*/
		$fields = array('id' => 'id','Nombre' => 'nombre_usuario','Email' => 'email', 'rol' => 'rol');
		/*	listar(campos,nombre,botones,vista,tamtabla);	*/
		return parent::getList($fields,$buttons,"",'11');
	}

	public function getModel()
	{
		return new User();
	}

	public function getObjectsToList()
	{
		$objects = $this->getModel()->getList(Input::all());
		$objects = RolsDefinition::convertObjectListFieldToDefinition($objects,'rol');
		return $objects;
	}

}