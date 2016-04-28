<!-- DEPRECATED -->

@foreach(UrlsAdm::getMenu() as $index => $value)
  <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> {{$index}}<b class="caret"></b></a>
      <ul class="dropdown-menu">
      @foreach($value as $name =>  $href)
        <li><a href="{{$href}}">{{$name}}</a></li>
      @endforeach
      </ul>
  </li>
@endforeach
<?php /*<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Home<b class="caret"></b></a>
  <ul class="dropdown-menu">
  	<li><a href="index.php?apartado=listado_home_sliders">Modificar sliders</a></li>
    <li><a href="index.php?apartado=crear_home_slider">Crear slider</a></li>
    <li><a href="index.php?apartado=listado_home_destacados">Modificar destacados</a></li>
  </ul>
</li>
<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Informes Técnicos<b class="caret"></b></a>
  <ul class="dropdown-menu">
    <li><a href="index.php?apartado=crear_informe_tecnico">Crear informe</a></li>
    <li><a href="index.php?apartado=listado_informe_tecnicos">Listado informes</a></li>
  </ul>
</li>
<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Instalaciones<b class="caret"></b></a>
  <ul class="dropdown-menu">
    <li><a href="index.php?apartado=crear_instalacion">Crear instalacion</a></li>
    <li><a href="index.php?apartado=listado_instalaciones">Listado instalaciones</a></li>
  </ul>
</li>
<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Servicios<b class="caret"></b></a>
  <ul class="dropdown-menu">
    <li><a href="index.php?apartado=crear_servicio">Crear servicio</a></li>
    <li><a href="index.php?apartado=listado_servicios">Listado servicios</a></li>
  </ul>
</li>
<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Calidad<b class="caret"></b></a>
  <ul class="dropdown-menu">
    <li><a href="index.php?apartado=crear_calidad">Crear calidad</a></li>
    <li><a href="index.php?apartado=listado_calidad">Listado calidads</a></li>
  </ul>
</li>
<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Noticias<b class="caret"></b></a>
  <ul class="dropdown-menu">
    <li><a href="index.php?apartado=crear_noticia">Crear noticia</a></li>
    <li><a href="index.php?apartado=listado_noticias">Listado noticias</a></li>
  </ul>
</li>
<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Productos<b class="caret"></b></a>
  <ul class="dropdown-menu">
    <li><a href="index.php?apartado=crear_producto">Crear producto</a></li>
    <li><a href="index.php?apartado=listado_productos">Listado productos</a></li>
  </ul>
</li>
<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Suscripciones<b class="caret"></b></a>
  <ul class="dropdown-menu">
    <li><a href="index.php?apartado=crear_suscripcion">Crear suscripcion</a></li>
    <li><a href="index.php?apartado=listado_suscripciones">Listado suscripciones</a></li>
  </ul>
</li>
<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Secciones<b class="caret"></b></a>
  <ul class="dropdown-menu">
    <li><a href="index.php?apartado=listado_secciones">Listado secciones</a></li>
  </ul>
</li>
<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Redes sociales<b class="caret"></b></a>
  <ul class="dropdown-menu">
    <li><a href="index.php?apartado=newredsocial">Crear red social</a></li>
    <li><a href="index.php?apartado=modredsocial">Listado redes sociales</a></li>
  </ul>
</li>
<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Imagenes Generales<b class="caret"></b></a>
  <ul class="dropdown-menu">
    <li><a href="index.php?apartado=modimg">Modificar imagenes generales de la web</a></li>    
  </ul>
</li>
<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-caret-square-o-down"></i> Metadatos<b class="caret"></b></a>
  <ul class="dropdown-menu">
    <li><a href="index.php?apartado=modmetatags">Listado de metadatos</a></li>      </ul>
</li>

<li class="dropdown">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> Usuarios<b class="caret"></b></a>
  <ul class="dropdown-menu">
    <li><a href="index.php?apartado=newuser">Crear usuario</a></li>
    <li><a href="index.php?apartado=moduser">Listado usuarios</a></li>    
  </ul>
</li>

*/ ?>


