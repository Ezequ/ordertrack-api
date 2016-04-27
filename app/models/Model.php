<?php

abstract class Model extends \Eloquent
{

	const PAGINATOR = 10;

	protected $allowedFilters = array();

	protected $_paginatation = self::PAGINATOR;

	/* List custom method */

	public function _getList($filters = array(),$paginate = false)
	{
		$model = $this;
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

	/* prepare filters  */
	protected static function getFilters($data)
	{
		$filters = array();
		foreach ($data as $filterName => $value){
			if (strpos($filterName,'>') == false && strpos($filterName,'<') == false && strpos($filterName,'%') == false){
				$filters[] = array('name' => $filterName, 'compare' => "=", 'value' => $value);
				continue;
			}
			if ($name = self::explodeFilter($filterName, ">")){
				$filters[] = array('name' => $name, 'compare' => ">", 'value' => $value);
				continue;
			}
			if ($name = self::explodeFilter($filterName, "<")){
				$filters[] = array('name' => $name, 'compare' => "<=", 'value' => $value);
				continue;
			}
			if ($name = self::explodeFilter($filterName, "%")){
				$filters[] = array('name' => $name, 'compare' => 'like', 'value' => "%" . $value ."%");
				continue;
			}
		}
		return $filters;
	}

	private static function explodeFilter($filter, $compare)
	{
		$resultStrpos = strpos($filter,$compare);
		return $resultStrpos ? substr($filter,0,strlen($filter)-1) : $resultStrpos;
	}

	protected function getModel()
	{

	}

	public  function getInputsForEdit()
	{
		return array();
	}

	public function getImagesForEdit()
	{
		return array();
	}

	public function getFiltersForList()
	{
		return array();
	}

	public static function getList($filters = array(),$paginate = false)
	{
		$called = get_called_class();
		$model = new $called;
		return $model->_getList($filters, $paginate);
	}

}