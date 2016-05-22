@extends('adm.templates.template')
@section('content')
<div class="page-title">
    <span class="title">{{$subSectionName}}</span>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-body">

                <div>
                    <form class="form-inline" action="{{UrlsAdm::getSchedule()}}" method="get" id="filters">
                        <div class="form-group form-group-lg">
                            <label class="">Semana: </label>
                            <select class="form-control" id="from" name="from" onchange="submit()">
                                @foreach(DatesHelper::getAllYearWeeks() as $firstDay => $week)
                                    <option value="{{$firstDay}}" {{$firstDay == Input::get('from') ? 'selected'  : ''}}>{{$week}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group form-group-lg margin-left">
                            <label class="">Vendedor: </label>
                            <select class="form-control" id="id" name="id" onchange="submit()">
                                @foreach(SellerDefinition::getDefinition() as $id => $name)
                                    <option value="{{$id}}" {{$id == Input::get('id') ? 'selected'  : ''}}>{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>

                <div class="sub-title"></div>

                <div class="row">
                    <div class="col-xs-12 col-md-9">
                        <div class="card primary card-agenda">
                            <div class="card-body no-padding">
                                <div class="agenda seven-cols">
                                    <div class='table'>
                                        <div class='row'>
                                            @foreach($days as $date => $day)
                                                <div class='cell col-md-1 day' data-day="{{$date}}">
                                                    <div class="header">
                                                        <h1>{{$day['name']}}</h1>
                                                        <h2>{{$date}}</h2>
                                                    </div>
                                                    <div class="content container-{{$day['name']}}">
                                                        @foreach($day['customers'] as $customer)
                                                            <a id="buttonClient" type="button" data-assigned="true" class="btn btn-default btn-sm agenda-event {{$customer->fecha_visita_concretada != null ? 'disabled' : ''}} agenda-popover" data-customer="{{$customer->id_cliente}}" data-date="{{$customer->fecha_visita_programada}}">{{$customer->razon_social}}</a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-3">
                        <div class="card">
                            <div class="card-body no-padding">
                                <div class="agenda-clients">
                                    <header>
                                        <span>Clientes sin asignar</span>
                                        <a type="button" class="btn btn-link btn-sm btn-circle pull-right" href="" data-toggle="tooltip" title="Asignar días por defecto"><i class="fa fa-random"></i></a>
                                    </header>
                                    <div class="agenda-clients-list">
                                        @foreach($notScheduledCustomers as $customer)
                                            <a id="buttonClient" type="button" data-assigned="false" class="btn btn-default btn-sm agenda-event agenda-popover" data-customer="{{$customer->id}}" >{{$customer->razon_social}}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<div id="content" class="hide">
    <button type="button" class="close">
         &times;
    </button>

    <div class="form-inline ">
        <select class="week-day form-control">
            @foreach($days as $date => $day)
                <option value="{{$date}}">{{$day['name']}}</option>
            @endforeach
        </select>
        <button type="button" class="btn btn-info btn-sm save" data-toggle="tooltip" title="Guardar" >
            <i class="fa fa-save"></i>
        </button>
        <button type="button" class="btn btn-danger btn-sm remove" disabled="disabled" data-toggle="tooltip" title="Eliminar asignación" >
            <i class="fa fa-calendar-times-o"></i>
        </button>
    </div>
</div>

@endsection
@section('scripts')
<script>

$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
});


function submit() {
    submit();
}


var $elements = $('.agenda-popover');
var destination = "div2";
var $activePopover = null;

$elements.each(function () {
    var $element = $(this);
    
    $element.popover({
        html: true,
        placement: 'bottom',
        title: '<b>Editar fecha</b>',
        container: $('body'), // This is just so the btn-group doesn't get messed up... also makes sorting the z-index issue easier
        content: $('#content').html()
    });


    $element.on('click', function() {
        var client_assigned = $element.data('assigned');
        var customer_id = $element.data('customer');
        var date = $element.data('date');
        var $tip = $element.data('bs.popover').tip();
        var tip0 = $tip[0];
        if (tip0){
            $("#"+tip0.id).find('.save').attr("customer",customer_id);
            $("#"+tip0.id).find('.remove').attr("customer",customer_id);
            $("#"+tip0.id).find('.remove').attr("date",date);
        }
        if(client_assigned) {
            $tip.find('button.remove').prop('disabled', false);

            $week_day = $element.closest('.day').data('day');
            $select = $tip.find('.week-day');
            $select.val($week_day);
        }
    });
    
    $element.on('shown.bs.popover', function () {

        /*if($activePopover) {
            $activePopover.hide();
        }*/

        var popover = $element.data('bs.popover');
        /*$activePopover = popover;*/

        if (typeof popover !== "undefined") {

            var $tip = popover.tip();

            /*if(client_assigned) {
                $tip.find('button.remove').prop('disabled', false);

                $week_day = $element.closest('.day').data('day');
                $select = $tip.find('.week-day');
                $select.val($week_day);
            }*/

            $tip.find('.close').bind('click', function () {
                /*$activePopover = null;*/

                popover.hide();
            });

            $tip.find('.save').bind('click', function () {
                /*$activePopover = null;*/
                popover.hide();
                customer_id = this.getAttribute('customer');
                date = this.previousElementSibling.value;
                $.ajax({
                    url: "{{UrlsAdm::getSaveScheduleUrl()}}",
                    data: {
                        format: 'json',
                        id: customer_id,
                        fecha_visita_programada: date,
                    },
                    error: function() {
                        console.log("asdasd");
                    },
                    success: function(data) {
                        console.log(data);
                        location.reload();
                    },
                    type: 'GET'
                });
                // Change position of client
                /*var fragment = document.createDocumentFragment();
                fragment.appendChild(document.getElementById('buttonClient'));
                document.getElementById(destination).appendChild(fragment);*/
                
                if(destination == 'div2')
                    destination = 'div1';
                else
                    destination = 'div2';
            });

            $tip.find('.remove').bind('click', function () {
                customer_id = this.getAttribute('customer');
                dateat = this.getAttribute('date');
                $.ajax({
                    url: "{{UrlsAdm::getDeleteScheduleUrl()}}",
                    data: {
                        format: 'json',
                        id: customer_id,
                        date: dateat,
                    },
                    error: function() {
                        console.log("asdasd");
                    },
                    success: function(data) {
                        console.log(data);
                        location.reload();
                    },
                    type: 'GET'
                });
            });
        }
    });
});


</script>
@endsection