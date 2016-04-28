<!--<nav class="navbar navbar-default no-margin">
	
	<div class="navbar-header fixed-brand">
	    <button type="button" class="navbar-toggle" data-toggle="collapse" id="menu-toggle">
	      <span class="fa fa-th-large" aria-hidden="true"></span>
	    </button>
	    <a class="navbar-brand" href="http://seegatesite.com/bootstrap/simple_sidebar_menu.html#"><i class="fa fa-rocket fa-4"></i> SEEGATESITE</a>        
	</div>

	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	            <ul class="nav navbar-nav">
	                <li class="active"><button class="navbar-toggle collapse in" data-toggle="collapse" id="menu-toggle-2"> <span class="fa fa-th-large" aria-hidden="true"></span></button></li>
	            </ul>
	</div>

	<ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
</nav>-->



<nav class="navbar navbar-default no-margin">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header fixed-brand">
    	<button type="button" class="navbar-toggle" data-toggle="collapse" id="menu-toggle">
    		<span class="fa fa-bars" aria-hidden="true"></span>
    	</button>
      <a class="navbar-brand" href="#">Order tracker</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><button class="navbar-toggle collapse in" data-toggle="collapse" id="menu-toggle-2"> <span class="fa fa-bars" aria-hidden="true"></span></button></li>
      </ul>

      <!--<form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>-->

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Auth::user()->nombre_usuario}} <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{UrlsAdm::getUserData()}}">Editar usuario</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="{{UrlsAdm::getLogout()}}">Salir</a></li>
          </ul>
        </li>
      </ul>
    </div>
</nav>