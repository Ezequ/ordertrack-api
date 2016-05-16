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
                                        <span data-toggle="tooltip" title="{{ $btnData['title'] }}">
                                            <a type="button" 
                                            href="{{ $btnData['href'] or '/adm/'.$name.'/'.$nameButton.'/'.$object->id}}
                                            id="{{ $nameButton }}" 
                                            data-id="{{ $object->id }}" data-module="{{ $name }}" data-althref="{{ $btnData['href'] }}"
                                            class="btn btn-{{ $btnData['type'] }} btn-sm {{ ($btnData['confirmation']) ? ('modalConfirm_' . $btnData['confirmationType']) : '' }}" 
                                            <?php if($btnData['confirmation']) { ?>
                                            data-toggle="modal" data-target="#modalConfirm_{{ $btnData['confirmationType'] }}"
                                            <?php } ?> >
                                                <i class="fa fa-{{ $btnData['icon'] }}"></i>
                                            </a>
                                        </span>
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

<!-- Modal: Confirmation REMOVE -->
<div class="modal fade modal-danger" id="modalConfirm_remove" tabindex="-1" role="danger" aria-labelledby="modalConfirm_remove" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Eliminar registro</h4>
            </div>
            <div class="modal-body">
                Se eliminará el registro, ¿desea continuar?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Volver</button>
                <button id="modaleConfirmBtn_remove" type="button" class="btn btn-danger">Confirmar</button>
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


        $(function() {
          var dt = $('.datatable').DataTable({
            "dom": '<"top"fl<"clear">>rt<"bottom"ip<"clear">>',
            "paging":   false,
            "info" : false,
            "responsive": true,
            "bAutoWidth":true, 
            "scrollX":        true,
            /*"scrollCollapse": true,*/
            "columnDefs": [
                { width: '3%', targets: 0 }
            ],
            "aaSorting": [],
            fixedColumns: true,
            "language": {
                   "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
          });


          return dt;
        });


        // Confirmation modal: REMOVE

        $('.modalConfirm_remove').on('click', function(e) {
            if($(this).hasClass('disabled')) {
                e.stopPropagation();
            }
        });

        $(document).on("click", ".modalConfirm_remove", function () {
             var id = $(this).data('id');
             var module = $(this).data('module');
             var altHref = $(this).data('althref');

             $('#modaleConfirmBtn_remove').off('click').on('click', function(e) {
                $('#modalConfirm_remove').modal('hide');
                 modalAction_remove(module, id, altHref);
            });
        });

        function modalAction_remove(module, id, altHref) {
            window.location.href = (altHref != '') ? altHref : '/adm/' + module + '/borrar/' + id;
        }

        //END Confirmation modal: REMOVE

    </script>
@endsection