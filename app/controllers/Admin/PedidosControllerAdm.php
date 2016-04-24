<?php /**
* 
*/
class PedidosControllerAdm extends AdminController
{
	public $name = "pedido";

	public function getListado()
	{
		die("asdasd");
		/* nombre acciones habilitadas*/
		$buttons = array('confirmar' => null);
		/* nombre => campo en base de datos	*/
		$fields = array('id' => 'id', 'Nombre' => 'nombre', 'Activo' => 'activo' );
		/*	listar(campos,nombre,botones,vista,tamtabla);	*/
		var_dump("ASDASD");die();
		return parent::getList($fields,$buttons,"",'8');
	}

	public function getModel()
	{
		return new Order();
	}

	public function getObjectsToList()
	{
		$objects = $this->getModel()->getList(Input::all());
		$objects = ClientsDefinition::convertObjectListFieldToDefinition($objects,'activo');
		return $objects;
	}

}