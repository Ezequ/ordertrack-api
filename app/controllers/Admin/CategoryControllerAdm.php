<?php /**
* 
*/
class CategoryControllerAdm extends AdminController
{
	public $name = "categoria";

	public function getListado()
	{
		/* nombre acciones habilitadas*/
		$buttons = array('editar' => null, 'borrar' => null);
		/* nombre => campo en base de datos	*/
		$fields = array('id' => 'id', 'Nombre' => 'nombre', 'Activo' => 'activo' );
		/*	listar(campos,nombre,botones,vista,tamtabla);	*/
		return parent::getList($fields,$buttons,null,'8');
	}

	public function getModel()
	{
		return new Category();
	}

	public function getObjectsToList()
	{
		$objects = $this->getModel()->getList(Input::all(),10);
		$objects = YesNoDefinition::convertObjectListFieldToDefinition($objects,'activo');
		return $objects;
	}

}