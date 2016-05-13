<?php /**
* 
*/
class CategoryControllerAdm extends AdminController
{
	protected $sectionName =  "Categorías";
	protected $subSectionName =  "Listado de categorías";

	public $name = "categoria";

	protected $nameList = "categorias";

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