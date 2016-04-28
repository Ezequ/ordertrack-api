@extends('adm.templates.template')
@section('content')

<div class="page-title">
    <span class="title">Bienvenido {{Auth::user()->username}}</span>
    <div class="description">Este es el sistema de administración de Order Tracker.</div>
</div>

@endsection