@if(Session::has('result'))
<div class="row" style="margin-top:15px">
  <div class="col-md-6">
     <div class="alert alert-{{Session::get('result') == 1 ? 'success' : 'danger'}} alert-dismissable">
      {{Session::get('message')}}
     </div>
  </div>
</div>
@endif