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
            'Telefono' => 'telefono', 'Direccion' => 'direccion', "Fecha visita programada" => "fecha_visita",
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
        $objects = Client::getList(Input::all(),true);
        $objects = SellerDefinition::convertObjectListFieldToDefinition($objects, 'id_vendedor');
        return $objects;
    }



    public function getPrint($id)
    {
        if($id){
            return View::make('adm.clientes.imprimir')->with('id',$id);
		}
    }

}