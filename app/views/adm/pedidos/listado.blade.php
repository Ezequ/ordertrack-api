@extends('adm.templates.template')
@section('content')
<div class="page-title">
    <span class="title">{{$subSectionName}}</span>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <!-- <div class="card-header">
                <div class="card-title">
                    <div class="title">Filtrar listado</div>
                </div>
            </div> -->
            <div class="card-body">
                <form class="form-inline" action="{{UrlsAdm::getPedidos()}}" method="get">
                    <div class="form-group form-group-sm">
                        <label class="">Estado</label>
                        <select class="form-control" id="id_estado" name="id_estado" >
                            <option value="">Elija un estado</option>
                            @foreach(OrderStatesDefinition::getDefinition() as $code => $name)
                                <option value="{{$code}}" {{$code == Input::get('id_estado') ? 'selected'  : ''}}>{{$name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="">Cliente</label>
                        <input type="text" class="form-control" placeholder="Cliente" name="razon_social%" value="{{Input::get('razon_social%')}}">
                    </div>
                    @if(!Auth::user()->isSeller())
                    <div class="form-group form-group-sm">
                        <label class="">Vendedor</label>
                        <input type="text" class="form-control" placeholder="Vendedor" name="nombre_usuario%" value="{{Input::get('nombre_usuario%')}}">
                    </div>
                    @endif
                    <div class="form-group form-group-sm">
                        <label class="">Desde</label>
                        <input type="text" class="form-control datepicker" placeholder="Desde" name="fecha_confirmacion>" value="{{Input::get('fecha_confirmacion>')}}">
                    </div>
                    <div class="form-group form-group-sm">
                        <label class="">Hasta</label>
                        <input type="text" class="form-control datepicker" placeholder="Hasta" name="fecha_confirmacion<" value="{{Input::get('fecha_confirmacion<')}}">
                    </div>
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">       
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">Pedidos</div>
                </div>
            </div>
            <div class="card-body">
               <!-- <div class="panel panel-default">
                    <div class="panel-body">
                        <form class="form-inline" action="{{UrlsAdm::getPedidos()}}" method="get">
                            <div class="form-group form-group-sm">
                                <label class="">Estado</label>
                                <select class="form-control" id="id_estado" name="id_estado" >
                                    <option value="">Elija un estado</option>
                                    @foreach(OrderStatesDefinition::getDefinition() as $code => $name)
                                        <option value="{{$code}}" {{$code == Input::get('id_estado') ? 'selected'  : ''}}>{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="">Cliente</label>
                                <input type="text" class="form-control" placeholder="Cliente" name="razon_social%" value="{{Input::get('razon_social%')}}">
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="">Vendedor</label>
                                <input type="text" class="form-control" placeholder="Vendedor" name="nombre_usuario%" value="{{Input::get('nombre_usuario%')}}">
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="">Desde</label>
                                <input type="text" class="form-control datepicker" placeholder="Desde" name="fecha_confirmacion>" value="{{Input::get('fecha_confirmacion>')}}">
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="">Hasta</label>
                                <input type="text" class="form-control datepicker" placeholder="Hasta" name="fecha_confirmacion<" value="{{Input::get('fecha_confirmacion<')}}">
                            </div>
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>    -->       
                <table class="datatable table table-hover table-striped dt-responsive display responsive nowrap">
                    <thead>
                    <tr>
                        @foreach($fields as $index => $field)
                            <th class="header">{{$index}}</th>
                        @endforeach
                        <th class="header text-center" style="width: 10%;">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($objects as $object)
                        <tr>
                            @foreach($fields as $index => $field)
                                <td>{{$object->$field}}</td>
                            @endforeach
                            <td class="text-left">
                                <button type="button" class="btn btn-info btn-sm" onclick="viewDetail('{{$object->id}}')" data-toggle="tooltip" title="Ver detalle">
                                    <i class="fa fa-eye"></i>
                                </button>
                                @if(!Auth::user()->isSeller())
                                <?php $previousData = $object->getStateButton();
                                    $nextData = $object->getStateButton(false);?>
                                <span data-toggle="tooltip" title="Cancelar"><button type="button" data-toggle="modal" data-target="#modalCancelOrder" class="btn btn-danger btn-sm modalCancelOrder {{ ($previousData) ? '' : 'disabled' }}" data-id="{{$object->id}}" data-state="{{$previousData['id_estado']}}">
                                    <i class="fa fa-close"></i>
                                </button></span>
                                
                                @if($nextData)
                                    <a href="#" type="button" class="btn btn-success btn-sm" onclick="changeStatus('{{$object->id}}','{{$nextData['id_estado']}}')">{{$nextData['nombre']}}</a>
                                @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{method_exists($objects, 'links') ? $objects->appends(Input::except('page'))->links() : ''}}
            </div>
        </div>
    </div>
</div>
<!-- Modal: View order details -->
<div class="modal fade bs-example-modal-lg modal-success" id="myModal" tabindex="-1" role="success" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Detalle del pedido</h4>
            </div>
            <div class="modal-content-bis">
            </div>
        </div>
    </div>
</div>


<!-- Modal: Cancel order -->
<div class="modal fade modal-danger" id="modalCancelOrder" tabindex="-1" role="danger" aria-labelledby="modalCancelOrder" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cancelar pedido</h4>
            </div>
            <div class="modal-body">
                Se cancelará el pedido N° <span id="orderId"></span>, ¿desea continuar?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Volver</button>
                <button id="modalCancelOrderConfirm" type="button" class="btn btn-danger">Confirmar cancelación</button>
            </div>
        </div>
    </div>
</div>



@endsection
@section('scripts')
    
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
            modal = $('#myModal .modal-content-bis');
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


    $('.datepicker').datepicker({ dateFormat: 'yy-mm-dd' });


    $('.modalCancelOrder').on('click', function(e) {
        if($(this).hasClass('disabled')) {
            e.stopPropagation();
        }  
    });

    $(document).on("click", ".modalCancelOrder", function () {
         var orderId = $(this).data('id');
         var orderState = $(this).data('state');
         $("#modalCancelOrder .modal-body #orderId").html(orderId);

         $('#modalCancelOrderConfirm').off('click').on('click', function(e) {
              $('#modalCancelOrder').modal('hide');
             changeStatus(orderId,orderState);
        });
    });

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
    });

</script>
@endsection
