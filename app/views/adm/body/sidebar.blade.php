<div class="side-menu sidebar-inverse">
    <nav class="navbar navbar-default" role="navigation">
        <div class="side-menu-container">
            <div class="navbar-header">
                <a class="navbar-brand" href="/adm/">
                    <div class="icon icon-logo">
                        <img src="{{Config::get('constants.url_imagenes') . 'logo/logo.svg'}}" alt="Order Tracker logo "/>
                    </div>
                    <div class="title">Order Tracker</div>
                </a>
                <button type="button" class="navbar-expand-toggle pull-right visible-xs">
                    <i class="fa fa-times icon"></i>
                </button>
            </div>
            <ul class="nav navbar-nav">
                <!--<li class="panel panel-default dropdown {{ ($sectionName == 'Inicio') ? 'active' : '' }}">
                    <a href="/">
                        <span class="icon fa fa-home"></span><span class="title">Inicio</span>
                    </a>
                </li>-->
                <?php $i=0 ?>
                @foreach(UrlsAdm::getMenu() as $index => $value)
                <li class="panel panel-default dropdown {{ ($sectionName == $index) ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#dropdown-element-{{ $i }}">
                        <span class="icon fa fa-{{ $value['icon'] }}"></span><span class="title">{{$index}}</span>
                    </a>
                    <!-- Dropdown level 1 -->
                    <div id="dropdown-element-{{ $i }}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul class="nav navbar-nav">
                                @foreach($value['submenu'] as $name =>  $href)
                                <li class=""><a href="{{$href}}">{{$name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </li>
                <?php $i++ ?>
                @endforeach
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
</div>



