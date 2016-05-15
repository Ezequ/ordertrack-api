<?php /**
* 
*/
class ProductsControllerAdm extends AdminController
{
	protected $sectionName =  "Productos";
	protected $subSectionName =  "Listado de productos";

	public $name = "producto";

	protected $nameList =  "productos";

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
		$objects = ProductsPricesDefinition::convertObjectListFieldToDefinition($objects,'precio');
		return $objects;
	}

}