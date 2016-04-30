<?php /**
* 
*/
class ProductsControllerAdm extends AdminController
{
	public $name = "producto";

	protected $nameList =  "productos";

	public function getListado()
	{
		/* nombre acciones habilitadas*/
		$buttons = array('editar' => null, 'borrar' => null);
		/* nombre => campo en base de datos	*/
		$fields = array('id' => 'id', 'nombre' => 'nombre', 'Marca' => 'marca', 'Precio' => 'precio', 'Stock' => 'stock');
		/*	listar(campos,nombre,botones,vista,tamtabla);	*/
		return parent::getList($fields,$buttons,null,'12');
	}

	public function getModel()
	{
		return new Product();

	}

	public function getObjectsToList()
	{
		$objects = $this->getModel()->getList(Input::all(),true);
		$objects = YesNoDefinition::convertObjectListFieldToDefinition($objects,'activo');
		return $objects;
	}

}