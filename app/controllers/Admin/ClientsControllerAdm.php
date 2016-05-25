<?php
class ClientsControllerAdm extends AdminController
{
    protected $sectionName =  "Clientes";
    protected $subSectionName =  "Listado de clientes";

    public $name = "cliente";
    protected $nameList =  "clientes";

    public function getListado()
    {
        /* nombre acciones habilitadas*/
        $buttons = array('detalle' => null);
        /* nombre => campo en base de datos	*/
        $fields = array('id' => 'id', 'Razón social' => 'razon_social', 'Vendedor' => 'id_vendedor' ,
            'Teléfono' => 'telefono', 'Dirección' => 'direccion',
            );
        /*	listar(campos,nombre,botones,vista,tamtabla);	*/
        return parent::getList($fields,$buttons,"adm.clientes.listado",'12');
    }

    public function getModel()
    {
        return new Client();
    }

    public function getObjectsToList()
    {
        $data = Input::all();
        if (Auth::user()->isSeller()){
            $data['id_vendedor'] = Auth::user()->id;
        }
        $data['estado>'] = ClientsStatesDefinition::STATE_NORMAL; // Exclude clients with state 0
        $objects = Client::getList($data,true);
        $objects = SellerDefinition::convertObjectListFieldToDefinition($objects, 'id_vendedor');
        return $objects;
    }



    public function getPrint($id)
    {
        if($id){
            return View::make('adm.clientes.imprimir')->with('id',$id);
		}
    }

    public function getDelete($id)
    {
        $client = Client::find($id);
        if ($client){
            $client->estado = ClientsStatesDefinition::STATE_DELETED;
            $client->save();
        }
        return Redirect::back();
    }

    public function postCreate($data = null)
    {
        $data = Input::all();
        $data['fecha_visita'] = date("Y-m-d");
        return parent::postCreate($data);
    }

}