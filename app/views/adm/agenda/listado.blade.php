@extends('adm.templates.template')
@section('content')
    <div class="page-title">
        <span class="title">{{$subSectionName}}</span>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-body">
                    <form class="form-inline" action="{{UrlsAdm::getSchedule()}}" method="get" id="filters">
                        <div class="form-group form-group-lg">
                            <label class="">Semana</label>
                            <select class="form-control" id="from" name="from" onchange="submit()">
                                @foreach(DatesHelper::getAllYearWeeks() as $firstDay => $week)
                                    <option value="{{$firstDay}}" {{$firstDay == Input::get('from') ? 'selected'  : ''}}>{{$week}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group form-group-lg">
                            <label class="">Vendedor</label>
                            <select class="form-control" id="id" name="id" onchange="submit()">
                                @foreach(SellerDefinition::getDefinition() as $id => $name)
                                    <option value="{{$id}}" {{$id == Input::get('id') ? 'selected'  : ''}}>{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function submit()
    {
        submit();
    }
</script>
