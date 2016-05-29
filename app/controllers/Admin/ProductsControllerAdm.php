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

	

	public function postCreateWhitNotif($data = null)
	{
		$data = $data ? $data : Input::all();
 		$object =  $this->getModel();
 		$result = false;
		if($object)
		{
			$rules = $this->customRule($object::$rules,$object->id);
			$validation = \Illuminate\Support\Facades\Validator::make($data, $rules, $object::$messages);
			if ($validation->fails()){
				return Redirect::back()->withErrors($validation)->withInput($data);
			}
			$object->fill($data);
			$object->save();
			if($object->id) 
			{
				PushNotification::app('fiuba-order-tracker')
                ->to("758199789160")
                ->send('Stock actualizado: '. $object->stock . ' - ' . $object->nombre);
				$url = "/adm/".$this->name;
				return Redirect::to($url);	
			}
			else
			{
				$message = "No se pudo completar la operación";
				return Redirect::back()->with('message',$message)->with('result',$result);	
			} 
		}
		else
		{
			$message = "No se pudo completar la operación";
			return Redirect::back()->with('message',$message)->with('result',$result);
		}
	}

	public function postEditWhitNotif($id)
	{
 		$object = $this->getObjectToModify($id);
 		$oldStock = $object->stock;

		if($object)
		{
			$rules = $this->customRule($object::$rules,$object->id);
			$validation = \Illuminate\Support\Facades\Validator::make(Input::all(), $rules, $object::$messages);
			if ($validation->fails()){
				return Redirect::back()->withErrors($validation)->withInput(Input::all());
			}
			$result = $object->update(Input::all());
			$objectUpdated = $this->getObjectToModify($id);
			if($result){ 
				$message = "Operación exitosa ! ";
				if($oldStock <= 0){
					PushNotification::app('fiuba-order-tracker')
	                ->to("758199789160")
	                ->send('Stock actualizado: '. $objectUpdated->stock . ' - ' . $objectUpdated->nombre);
                }
			}else{ 
				$message = "No se pudo completar la operación";
			}
			return Redirect::to('/adm/'.$this->name)->with('message',$message)->with('result',$result);
		}
		else
		{
			$message = "No se pudo completar la operación";
			return Redirect::back()->with('message',$message);
		}
	}

}