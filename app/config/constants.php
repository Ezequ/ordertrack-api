<?php
$globals = array();
$globals['titulo_web'] = "Order track";
$globals['pait'] = "/";
//$globals['hd_root'] = "C:\\\\lamp\\\\www\\\\sericor\\\\";
$globals['hd_root'] = "/home/ezequiel/ordertrack-api/";
//$globals['hd_imagenes'] = $globals['hd_root'] . "public\\\\img\\\\";
$globals['hd_imagenes'] = $globals['hd_root'] . "public/img/";
//$globals['hd_documentos']= $globals['hd_root'] . "public\\\\documentos\\\\";
$globals['hd_documentos']= $globals['hd_root'] . "public/documentos/";
$globals['url_root'] = "http:\\\\".Request::server('HTTP_HOST');
$globals['url_imagenes'] = "/img/";
$globals['url_documentos'] =  $globals['url_root'] . "documentos/";
$globals['url_no_foto'] = "/img/genericas/sin_foto.jpg";
$globals['url_genericas'] = "/img/genericas/";
$globals['url_css'] = "/assets/css/";
$globals['url_css_adm'] = "/assets/css/adm/";
$globals['url_js_adm'] = "/assets/js/adm/";
return $globals;