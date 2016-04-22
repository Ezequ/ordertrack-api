<?php /**
* 
*/
abstract class AdminController extends BaseController
{
	public function getList($fields,$buttons, $view = "",$tamCol = "")
	{
		$objects = $this->getObjectsToList();
		if($tamCol == "") $tamCol = '12';
		if($view == "")
		{
			return View::make('adm.templates.listado')
					->with("objects", $objects)
					->with("name", $this->name)
					->with("buttons", $buttons)
					->with("tamCol", $tamCol)
					->with("fields", $fields);
		}
	}

	public function getEdit($id,$url = "", $back = "")
	{
		$object = $this->getObjectToModify($id);
		if(!$url) $url = "/adm/".$this->name."/editar/$id";
		if(!$back) $back = "/adm/".$this->name;
		if($object)
		{
			return View::make('adm.templates.editar')
				   ->with("object", $object)
				   ->with("name", $this->name)
				   ->with("back", $back)
				   ->with("url", $url);
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
				   ->with("url", $url);
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
				$url = "/adm/".$this->name."/editar/$object->id";
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
			return Redirect::back()->with('message',$message)->with('result',$result);
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
	
	public abstract function getModel();

}