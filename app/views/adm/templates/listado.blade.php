@extends('adm.templates.template')
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-md-{{$tamCol}}">
            <?php
            $f = new Formularios();
            $f->cabecera(ucfirst($name),'Seleccione un item para modificar o borrar.');
            $f->generarForm();
            ?>
            <?php
            $filters = $model->getFiltersForList();
            if (count($filters)){
                $f = new Formularios();
                $f->inicioForm('get',$name);
                foreach ($filters as $key => $input)
                {
                    for ($i=1; $i < 6; $i++) {
                        if(!isset($input['data'.$i])) $input['data'.$i] = "";
                    }
                    $f->addGenericInput($input['type'], $input['data1'],  $input['data2'],  $input['data3'],  $input['data4'],  $input['data5']);
                }
                $f->addSubmit('Buscar','','');
                $f->generarForm();
            }
            ?>
        </div>
    </div>
    <div class="row">
		<div class="col-lg-{{$tamCol}}">
			<div class="table-responsive">
                <table class="table table-bordered table-hover tablesorter" style="table-layout: fixed">
                  	<thead>
	                    <tr>
                            @foreach($fields as $index => $field)
                                <th class="header">{{$index}}</th>
                            @endforeach
		             		    <th class="header" style="text-align:center">Acciones</th> 
	             		</tr>
                  	</thead>
                	<tbody>
                    @foreach($objects as $object)
                        <tr>
                            @foreach($fields as $index => $field)
                                <th>{{$object->$field}}</th>
                            @endforeach
                            <th>
                                <div class="botones_columna">
                                    @foreach($buttons as $nameButton => $href)
                                        <a id="{{$nameButton}}" style="margin-left:15px" href="{{$href or '/adm/'.$name.'/'.$nameButton.'/'.$object->id}}" class="btn btn-default">{{$nameButton}}</a>
                                    @endforeach
                                </div>
                            </th>	
                        </tr>
                    @endforeach
			    	</tbody>
              	</table>
            </div>
		</div>
	</div>

    <div class="row">
        <div class="col-lg-{{$tamCol}}">
            {{method_exists($objects, 'links') ? $objects->links() : ''}}
        </div>
    </div>
</div><!-- /#page-wrapper -->
@endsection