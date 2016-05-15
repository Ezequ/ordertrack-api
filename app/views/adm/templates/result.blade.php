@if(isset($errors) && $errors->getMessages())
<div class="alert alert-danger alert-dismissible" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Ocultar"><span aria-hidden="true">×</span></button>
	<p style="margin-bottom: 10px;"><strong><i class="fa fa-exclamation-circle" style="font-size: 20px"></i> Debe completar los campos obligatorios:</strong></p>
	@foreach($errors->getMessages() as $message)
	    @foreach($message as $m)
	    <i class="fa fa-angle-right"></i> {{$m}} <br>
	    @endforeach
	@endforeach
</div>
@endif