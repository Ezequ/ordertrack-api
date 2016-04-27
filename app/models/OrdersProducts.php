<?php
class OrdersProducts extends Eloquent
{
    protected $table = 'productos_ordenes';

    protected $fillable = ["id_orden", "id_producto", "cantidad"];


    public function getListForAdmin($filters = array(),$paginate = false)
    {
        $model = DB::table('ordenes')
                ->leftJoin('clientes', 'ordenes.id_cliente', '=', 'clientes.id')
                ->leftJoin('usuarios', 'usuarios.id', '=', 'clientes.id_vendedor');

        $filtersToCompare =  self::getFilters($filters);
        foreach ($filtersToCompare as $filter){
            if (in_array($filter['name'],$this->allowedFilters)){
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