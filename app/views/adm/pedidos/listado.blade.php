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
            </div>
        </div>
        <div class="row">
            <div class="col-lg-{{$tamCol}}">
                <div class="table-responsive content-table">
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
                                    <td>{{$object->$field}}</td>
                                @endforeach
                                <td style="width:40%">
                                    <div class="botones_columna">
                                        <button type="button" class="btn btn-primary" onclick="viewDetail('{{$object->id}}')">Ver detalle</button>
                                        <?php $previousData = $object->getStateButton();
                                            $nextData = $object->getStateButton(false);?>
                                        @if($previousData)
                                            <a style="margin-left:15px" href="#" class="btn btn-default" onclick="changeStatus('{{$object->id}}','{{$previousData['id_estado']}}')">Cambiar a {{$previousData['nombre']}}</a>
                                        @endif
                                        @if($nextData)
                                            <a style="margin-left:15px" href="#" class="btn btn-default" onclick="changeStatus('{{$object->id}}','{{$nextData['id_estado']}}')">Cambiar a {{$nextData['nombre']}}</a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" style="float: left;">Close</button>
                        <a href="#" class="btn btn-info" style="float: right">Cambiar estado</a>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /#page-wrapper -->
@endsection
<style>
    .table{
        width: inherit !important;
    }
    .table td{
        word-break: break-all;
    }
</style>
<script>
    function changeStatus(id,status)
    {
        var urlStatus = "{{UrlsAdm::getChangeStatus()}}";
        $.ajax({
            url: urlStatus + "?id=" + id + "&status=" + status,
            context: document.body
        }).done(function() {
            location.reload();
        });
    }

    function viewDetail(id)
    {
        var urlDetail = "{{UrlsAdm::getDetalle()}}";
        $.ajax({
            url: urlDetail + id,
            context: document.body
        }).done(function(response) {
            $('.modal-body').empty();
            $('.modal-body').append(response);
            $('#myModal').modal('show');
        });
    }




</script>