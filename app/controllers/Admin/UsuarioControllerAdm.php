<?php /**
* 
*/
class UsuarioControllerAdm extends AdminController
{
	protected $sectionName =  "Usuarios";
	protected $subSectionName =  "Listado de usuarios";

	public $name = "usuario";

	public function getListado()
	{
		/* nombre acciones habilitadas*/
		$buttons = array(
			'editar' => array(
				'title'				=> 'Editar',
				'href'				=> null,
				'icon'				=> 'edit',
				'type'				=> 'info',
				'confirmation'		=> false,
				'confirmationType'	=> null
			), 
			'borrar' => array(
				'title' 			=> 'Eliminar',
				'href'				=> null,
				'icon'				=> 'trash-o',
				'type'				=> 'danger',
				'confirmation'		=> true,
				'confirmationType'	=> 'remove'
			)
		);

		/* nombre => campo en base de datos	*/
		$fields = array('id' => 'id','Nombre' => 'nombre_usuario','Email' => 'email', 'rol' => 'rol');
		/*	listar(campos,nombre,botones,vista,tamtabla);	*/
		return parent::getList($fields,$buttons,null,'11');
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