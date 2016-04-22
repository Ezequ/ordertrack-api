
<html>
<head>
	@include("adm.head.head")
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
	<body style="margin-top:0px !important">
		<form id="form" method="post" enctype="multipart/form-data" name="imagen" action="/adm/editar_foto?nombre={{Input::get('nombre')}}&ruta_disco={{Input::get('ruta_disco')}}&ruta={{Input::get('ruta')}}" >
			<table width="350" border="0" cellspacing="0" cellpadding="0">
			  <tr> 
				<td bgcolor="#f3f3f3"><b><?if(isset($_GET["txt_titulo"])){ echo $_GET["txt_titulo"];}?></b></td>
			  </tr>
			</table>
			<br>
			<input type="submit" value="Aceptar" name="bt_aceptar" class="boton">&nbsp;
			<input type="button" value="Borrar" name="bt_borrar"  class="boton" onclick="borrar()">&nbsp;
			<input type="button" value="Cerrar" onClick="window.close()">&nbsp;
			<br><br>
			Archivo:&nbsp;<input type="FILE" size="45" name="FILE1" id="txt ">
			<br><br>
		   <?php
			 if (isset($archivo) && $archivo <> "" && isset($ruta))
			  {
			  ?>	    
		        <center><a href="<?php echo $ruta . $archivo; ?>"><?=$archivo?></a></center>	
				<br>
		    <?php 
				 $ruta_disco=str_replace( '\\','/', $ruta_disco);
				}
			?> 		
		</form>
	<?php $foto = ManejoArchivos::existe_foto($nombre, $ruta) ?>
	@if($foto != Config::get('constants.url_no_foto'))
	<img src="{{$foto}}">
	@endif
	</body>

<script type="text/javascript">
function borrar()
{
	window.location = "/adm/borrar_foto?nombre={{Input::get('nombre')}}&ruta_disco={{Input::get('ruta_disco')}}&ruta={{Input::get('ruta')}}";
}
</script>
</html>
@if(Session::has('msg'))
<script type="text/javascript">
	$(document).ready(function()
	{
		alert("{{Session::get('msg')}}");
		window.close();
	});
</script>
@endif

