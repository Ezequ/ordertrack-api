  <!-- DEPRECATED -->

  <!-- Sidebar -->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="adm">Panel de administración - {{Config::get('constants.titulo_web')}}</a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <ul class="nav navbar-nav side-nav">
        @include('adm.body.menu')               
      </ul>

      <ul class="nav navbar-nav navbar-right navbar-user" style="margin-top: 8px;">
        <div class="dropdown">
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li><a href="{{UrlsAdm::getUserData()}}">Editar usuario</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{UrlsAdm::getLogout()}}">Salir</a></li>
            <!--<li><a href="#">Another action</a></li>
            <li><a href="#">Separated link</a></li>-->
          </ul>
          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">{{Auth::user()->nombre_usuario}}
            <span class="caret"></span>
          </button>
        </div>
      </ul>
    </div><!-- /.navbar-collapse -->
  </nav>
