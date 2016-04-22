@extends('adm.templates.template')
@section('content')
<div id="page-wrapper">
<?php
  $f = new Formularios();
  $f->cabecera(ucfirst($name),'Complete el siguiente formulario para modificar.'); 
  $f->inicioForm('post',$url);
  foreach ($object->getInputsForEdit() as $key => $input) 
  {
  	for ($i=1; $i < 6; $i++) {
      	if(!isset($input['data'.$i])) $input['data'.$i] = ""; 
  	}
  	$f->addGenericInput($input['type'], $input['data1'],  $input['data2'],  $input['data3'],  $input['data4'],  $input['data5']);
  }
  $f->addSubmit('Modificar','aceptar','aceptar');
  $f->addBack($back);
  $f->finForm();
  $f->generarForm(); 
  //require_once("views/layout/result.phtml");
?>
</div>
@endsection
