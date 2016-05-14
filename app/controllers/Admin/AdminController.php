<?php /**
* 
*/
abstract class AdminController extends BaseController
{

	protected $nameList = "";

	public function getList($fields,$buttons, $view = "adm.templates.listado",$tamCol = "")
	{
		$objects = $this->getObjectsToList();
		if($tamCol == "") $tamCol = '12';
		$view = $view ? $view : "adm.templates.listado";
		return View::make($view)
				->with('model', $this->getModel())
				->with("objects", $objects)
				->with("nameList", $this->nameList)
				->with("sectionName", $this->sectionName)
				->with("subSectionName", $this->subSectionName)
				->with("nameList", $this->nameList)
				->with("name", $this->name)
				->with("buttons", $buttons)
				->with("tamCol", $tamCol)
				->with("fields", $fields);
	}

	public function getEdit($id,$url = "", $back = "")
	{
		$object = $this->getObjectToModify($id);
		$filters = $this->getFilters();
		if(!$url) $url = "/adm/".$this->name."/editar/$id";
		if(!$back) $back = "/adm/".$this->name;
		if($object)
		{
			return View::make('adm.templates.editar')
				   ->with("object", $object)
				   ->with("name", $this->name)
				   ->with("back", $back)
				   ->with("filters", $filters)
				   ->with("url", $url)
				   ->with("sectionName", $this->sectionName)
				   ->with("subSectionName", $this->subSectionName);
		}
	}

	public function getCreate( $url = "", $back = "")
	{
		$object = $this->getModel();
		if(!$url) $url = "/adm/".$this->name."/crear";
		if(!$back) $back = "/adm/".$this->name;
		if($object)
		{
			return View::make('adm.templates.crear')
				   ->with("object", $object)
				   ->with("name", $this->name)
				   ->with("back", $back)
				   ->with("url", $url)
				   ->with("sectionName", $this->sectionName)
				   ->with("subSectionName", $this->subSectionName);
		}
	}

	public function postCreate()
	{
 		$object =  $this->getModel();
 		$result = false;
		if($object)
		{
			$object->fill(Input::all());
			$object->save();
			if($object->id) 
			{
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

	public function postEdit($id)
	{
 		$object = $this->getObjectToModify($id);
		if($object)
		{
			$result = $object->update(Input::all());
			if($result) $message = "Operación exitosa ! ";
			else $message = "No se pudo completar la operación";
			return Redirect::to('/adm/'.$this->name)->with('message',$message)->with('result',$result);
		}
		else
		{
			$message = "No se pudo completar la operación";
			return Redirect::back()->with('message',$message);
		}
	}

	public function getDelete($id)
	{
		$object = $this->getObjectToModify($id);
		if($object)
		{
			$result = $object->delete();
			if($result) $message = "Operación exitosa ! ";
			else $message = "No se pudo completar la operación";
			return Redirect::back()->with('message',$message)->with('result',$result);
		}
		else
		{
			$message = "No se pudo completar la operación";
			return Redirect::back()->with('message',$message);
		}
	}

	public function getObjectsToList()
	{
		return $this->getModel()->all();
	}

	public function getObjectToModify($id)
	{
		return $this->getModel()->find($id);
	}

	protected function getFilters()
	{
		return array();
	}
	
	public abstract function getModel();

	protected function getInputFilters()
	{
		$inputFilters = array();
		foreach (Input::all() as $index => $item) {
			if ($item != "" && $item != 0){
				$inputFilters[$index] = $item;
			}
		}
		return $inputFilters;
	}

}