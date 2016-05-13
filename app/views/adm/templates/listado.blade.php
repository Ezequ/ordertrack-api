@extends('adm.templates.template')
@section('content')
<div class="page-title">
    <span class="title">{{$subSectionName}}</span>
</div>


   <?php /* <div class="row">
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
    </div> */ ?>


<div class="row">
    <div class="col-xs-12">       
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">{{ $sectionName }}</div>
                </div>
                <div class="pull-right card-action">
                    <div class="btn-group" role="group">
                        <a type="button" class="btn btn-link btn-circle" href="/adm/{{ $name }}/crear" data-toggle="tooltip" title="Nuevo"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="datatable table table-hover table-striped dt-responsive display responsive nowrap">
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
                                <td>{{$object->$field}}</td>
                            @endforeach
                            <td class="text-center col-md-1">
                                <div class="botones_columna">
                                    @foreach($buttons as $nameButton => $btnData)
                                        <a type="button" id="{{$nameButton}}" href="{{$btnData['href'] or '/adm/'.$name.'/'.$nameButton.'/'.$object->id}}" class="btn btn-{{ $btnData['type'] }} btn-sm" data-toggle="tooltip" title="{{ $btnData['title'] }}">
                                            <i class="fa fa-{{ $btnData['icon'] }}"></i>
                                        </a>
                                    @endforeach
                                </div>
                            </td>	
                        </tr>
                    @endforeach
			    	</tbody>
              	</table>
                {{method_exists($objects, 'links') ? $objects->links() : ''}}
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection