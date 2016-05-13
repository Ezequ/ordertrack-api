@extends('adm.templates.template')
@section('content')
<div class="page-title">
    <span class="title">{{$subSectionName}}</span>
</div>
<div class="row">
    <div class="col-xs-12">       
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="title">Datos</div>
                </div>
            </div>
            <div class="card-body">
              <?php
                $f = new Formularios();
                $f->inicioForm('post',$url);
                foreach ($object->getInputsForEdit() as $key => $input) 
                {
                	for ($i=1; $i < 6; $i++) {
                    	if(!isset($input['data'.$i])) $input['data'.$i] = ""; 
                	}
                	$f->addGenericInput($input['type'], $input['data1'],  $input['data2'],  $input['data3'],  $input['data4'],  $input['data5']);
                }
                $f->addBack($back);
                $f->addSubmit('Crear','aceptar','aceptar');
                $f->finForm();
                $f->generarForm(); 
                //require_once("views/layout/result.phtml");
              ?>
            </div>
        </div>
    </div>
</div>
@endsection
