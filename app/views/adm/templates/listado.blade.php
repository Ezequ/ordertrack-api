@extends('adm.templates.template')
@section('content')
<div id="page-wrapper">
   <?php 
    $f = new Formularios();
    $f->cabecera(ucfirst($name),'Seleccione un item para modificar o borrar.'); 
    $f->generarForm();
    ?>    
	<?php ?>
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
                                        <a style="margin-left:15px" href="{{$href or '/adm/'.$name.'/'.$nameButton.'/'.$object->id}}" class="btn btn-default">{{$nameButton}}</a>
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
</div><!-- /#page-wrapper -->
@endsection