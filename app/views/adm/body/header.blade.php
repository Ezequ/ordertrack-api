<nav class="navbar navbar-default navbar-fixed-top navbar-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-expand-toggle">
                <i class="fa fa-bars icon"></i>
            </button>
            <ol class="breadcrumb navbar-breadcrumb">
                <li>{{$sectionName}}</li>
                <li class="active">{{$subSectionName}}</li>
            </ol>
            <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                <i class="fa fa-th icon"></i>
            </button>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                <i class="fa fa-times icon"></i>
            </button>
            <li class="dropdown profile">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{Auth::user()->nombre_usuario}} <span class="caret"></span></a>
                <ul class="dropdown-menu animated fadeInDown">
                    <li>
                        <div class="profile-info">
                            <h4 class="username">{{Auth::user()->nombre_usuario}}</h4>
                            <p>Administrador</p>
                            <div class="btn-group margin-bottom-2x" role="group">
                                <a href="{{UrlsAdm::getUserData()}}" type="button" class="btn btn-default"><i class="fa fa-user"></i> Perfil</a>
                                <a href="{{UrlsAdm::getLogout()}}" type="button" class="btn btn-default"><i class="fa fa-sign-out"></i> Cerrar sesión</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>