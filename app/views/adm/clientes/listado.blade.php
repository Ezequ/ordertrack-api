@extends('adm.templates.template')
@section('content')
<div class="page-title">
    <span class="title">{{$subSectionName}}</span>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <?php /*<div class="card-body">
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
            </div> */?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">       
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">Clientes</div>
                </div>
                <div class="pull-right card-action">
                    <div class="btn-group" role="group">
                        <a type="button" class="btn btn-link btn-circle" href="/adm/cliente/crear" data-toggle="tooltip" title="Nuevo"><i class="fa fa-plus"></i></a>
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
                                <button type="button" class="btn btn-info btn-sm" data-toggle="tooltip" title="Imprimir QR" onclick="printQRCode('{{UrlsAdm::getClientPrintQr($object->id)}}')">
                                    <i class="fa fa-print"></i>
                                </button>
                                <button type="button" class="btn btn-info btn-sm" data-toggle="tooltip" title="Editar"
                                onclick="window.location='{{UrlsAdm::getClientEdit($object->id)}}'">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Eliminar"
                                        onclick="window.location='{{UrlsAdm::getClientDelete($object->id)}}'">
                                    <i class="fa fa-trash-o"></i>
                                </button>
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


@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

        function printQRCode(url) {
            $("<iframe>")
                .hide()
                .attr("src", url)
                .appendTo("body");
        }
    </script>
@endsection
