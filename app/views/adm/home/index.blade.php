@extends('adm.templates.template')
@section('content')

<div class="row">
	<div class="col-md-12">
		<h1> Bienvenido {{Auth::user()->username}} </h1>
	</div>
</div>
@endsection