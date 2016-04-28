@extends('adm.templates.template')
@section('content')
    <div id="page-wrapper">
         <div class="row">
            <div class="col-md-{{$tamCol}}">
               <h1>Pedidos</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Filtros</h3>
                    </div>
                    <form action="{{UrlsAdm::getPedidos()}}" method="get">
                        <div class="panel-body">
                            <div class="col-md-4">
                                <div class="form-group" style="margin-right: 15px">
                                    <select class="form-control" id="id_estado" name="id_estado" >
                                        <option value="">Estado</option>
                                    @foreach(OrderStatesDefinition::getDefinition() as $code => $name)
                                            <option value="{{$code}}" {{$code == Input::get('id_estado') ? 'selected'  : ''}}>{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" style="margin-right: 15px">
                                    <input type="text" class="form-control" placeholder="Cliente" name="razon_social%" value="{{Input::get('razon_social%')}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" style="margin-right: 15px">
                                    <input type="text" class="form-control" placeholder="Vendedor" name="nombre_usuario%" value="{{Input::get('nombre_usuario%')}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group " style="margin-right: 15px">
                                    <input type="text" class="form-control datepicker" placeholder="Desde" name="updated_at>" value="{{Input::get('updated_at>')}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group " style="margin-right: 15px">
                                    <input type="text" class="form-control datepicker" placeholder="Hasta" name="updated_at<" value="{{Input::get('updated_at<')}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group " style="margin-right: 15px">
                                    <button type="submit" style="width: 100%;" class="btn btn-success">Buscar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
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
        <div class="row">
            <div class="col-lg-{{$tamCol}}">
                {{method_exists($objects, 'links') ? $objects->appends(Input::except('page'))->links() : ''}}
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">

                    </div>
                </div>
            </div>
        </div>
    </div><!-- /#page-wrapper -->
    <style>
        .table{
            width: inherit !important;
        }
        .table td{
            word-break: break-all;
        }
    </style>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript">
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
                modal = $('.modal-body');
                modal.empty();
                modal.append(response);
                /* $("#modalstate").attr("orderid", id);*/
                $('#myModal').modal('show');
            });
        }

        function modalChangeValue()
        {
            /* $('#myModal').modal('toggle');
             console.log("asd");*/
            modal = $("#modalstate");
            id = modal.attr("orderid");
            state =  modal.val();
            changeStatus(id,state);
        }

        (function() {
            $('.datepicker').datepicker({ dateFormat: 'yy-mm-dd' });
        })();



    </script>

@endsection
