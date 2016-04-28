@extends('adm.templates.template')
@section('content')

<div class="page-title">
    <span class="title">{{ ucfirst($name) }}</span>
    <div class="description">Seleccione un item para modificar o borrar.</div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">

                <div class="card-title">
                    <div class="title">Listado de pedidos</div>
                </div>
            </div>
            <div class="card-body">
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">Filtros</div>
                    <div class="panel-body">
                        <form action="{{UrlsAdm::getPedidos()}}" method="get">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select class="form-control" id="id_estado" name="id_estado" >
                                            <option value="">Estado</option>
                                        @foreach(OrderStatesDefinition::getDefinition() as $code => $name)
                                                <option value="{{$code}}" {{$code == Input::get('id_estado') ? 'selected'  : ''}}>{{$name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Cliente" name="razon_social%" value="{{Input::get('razon_social%')}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Vendedor" name="nombre_usuario%" value="{{Input::get('nombre_usuario%')}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control datepicker" placeholder="Desde" name="updated_at>" value="{{Input::get('updated_at>')}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control datepicker" placeholder="Hasta" name="updated_at<" value="{{Input::get('updated_at<')}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Buscar</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
                    <table class="datatable table table-hover">
                        <thead>
                        <tr>
                            @foreach($fields as $index => $field)
                                <th class="header">{{$index}}</th>
                            @endforeach
                            <th class="header">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($objects as $object)
                            <tr>
                                @foreach($fields as $index => $field)
                                    <td>{{$object->$field}}</td>
                                @endforeach
                                <td>
                                    <div class="botones_columna">
                                        <button type="button" class="btn btn-primary" onclick="viewDetail('{{$object->id}}')">Ver detalle</button>
                                        <?php $previousData = $object->getStateButton();
                                            $nextData = $object->getStateButton(false);?>
                                        @if($previousData)
                                            <a href="#" class="btn btn-default" onclick="changeStatus('{{$object->id}}','{{$previousData['id_estado']}}')">Cambiar a {{$previousData['nombre']}}</a>
                                        @endif
                                        @if($nextData)
                                            <a href="#" class="btn btn-default" onclick="changeStatus('{{$object->id}}','{{$nextData['id_estado']}}')">Cambiar a {{$nextData['nombre']}}</a>
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