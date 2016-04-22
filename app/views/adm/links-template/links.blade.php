<!--<link type="css/txt" rel="stylesheet" href="css/estilos_adm.css" />-->
<link href="{{Config::get('constants.url_css_adm')}}bootstrap.css" rel="stylesheet">
<link href="{{Config::get('constants.url_css_adm')}}sb-admin.css" rel="stylesheet">
<!-- Add custom CSS here -->
<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
<!--favicon-->
<link rel="shortcut icon" href="./img/plantilla/favicon.ico">
<!-- JavaScript -->
<script src="{{Config::get('constants.url_js_adm')}}jquery-1.10.2.js"></script>
<script src="{{Config::get('constants.url_js_adm')}}bootstrap.js"></script>

<!-- Page Specific Plugins -->
<script src="js/tablesorter/jquery.tablesorter.js"></script>
<script src="js/tablesorter/tables.js"></script>

<script>
function holas (apartado,id)
{
  window.location = '?apartado='+apartado+'&accion=borrar&id='+id;
}

function ventanaXY(X, Y, ancho, alto, URL, propiedades) {
  var windowprops = "left=" + X + ",top=" + Y + ",width=" + ancho + ",height=" + alto;
  if (propiedades != "") {
       popup = window.open(URL,"MenuPopup",windowprops+ "," +propiedades);
	   }
  else {
        popup = window.open(URL,"MenuPopup",windowprops);
        }
}

function ventanaXY_(X, Y, ancho, alto, URL, propiedades) {
  var windowprops = "left=" + X + ",top=" + Y + ",width=" + ancho + ",height=" + alto;
  if (propiedades != "") {
     windowprops = windoprops + "," + propiedades;
  }
  popup = window.open(URL,"MenuPopup",windowprops);
}
</script>


