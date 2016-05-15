@if(isset($errors) && $errors->getMessages())
<div class="row" style="margin-top:15px">
  <div class="col-md-6">
     <div class="alert alert-danger alert-dismissable">
      @foreach($errors->getMessages() as $message)
          @foreach($message as $m)
          {{$m}} <br>
          @endforeach
      @endforeach
     </div>
  </div>
</div>
@endif