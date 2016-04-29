<?php
class OrdersProducts extends Model
{
    protected $table = 'productos_ordenes';

    protected $fillable = ["id_orden", "id_producto", "cantidad"];

    protected $allowedFilters = ["razon_social", "nombre_usuario",'id_estado', 'id_cliente', 'id_vendedor', 'updated_at', 'created_at', 'fecha_confirmacion'];

    public function _getList($filters = array(),$paginate = false)
    {
        $model = DB::table('ordenes')
                ->leftJoin('clientes', 'ordenes.id_cliente', '=', 'clientes.id')
                ->leftJoin('users', 'users.id', '=', 'clientes.id_vendedor')
                ->select('ordenes.id');

        $filtersToCompare =  self::getFilters($filters);
        foreach ($filtersToCompare as $filter){
            if (in_array($filter['name'],$this->allowedFilters ) && $filter['value'] != ""){
                $model = $model->where($filter['name'],$filter['compare'], $filter['value']);
            }
        }
        if (isset($filters['orderby'])){
            $orderBy = $filters['orderby'];
            $orientation = isset($filters['orientation']) ? $filters['orientation'] : 'asc';
            $model = $model->orderBy($orderBy,$orientation);
        }
        if ($paginate){
            return $model->paginate($this->_paginatation);
        }
        return $model->get();
    }

}