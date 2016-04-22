<?php

class ManejoArchivos
{
	static $extenciones_fotos = array("jpg","png","gif","jpeg");
	static $extenciones_documentos = array("pdf","doc","docx");

	public static function getImage($name, $folder)
	{
		return Config::get("constants.hd_imagenes") . $folder . "/" . $name ;
	}

	public static function existe_foto( $nombre , $sliderfolder = "", $ruta = "" )
	{
		if($ruta == "") $ruta = Config::get("constants.hd_imagenes").$sliderfolder."/";
		foreach(ManejoArchivos::$extenciones_fotos as $extencion)
		{
				if(file_exists($ruta.$nombre.".".$extencion))
				{
					return Config::get('constants.url_imagenes').$sliderfolder."/".$nombre.".".$extencion;
				}	   		
		}
		return Config::get('constants.url_no_foto');		
	}

	public static function existe_documento( $nombre , $sliderfolder = "", $ruta = "" )
	{	
	   if($ruta == "") $ruta = Config::get("constants.hd_documentos").$sliderfolder."/";
	   foreach(ManejoArchivos::$extenciones_documentos as $extencion)
	   {
	   		if(file_exists($ruta.$nombre.".".$extencion))
	   		{	
	   			return $nombre.".".$extencion;
	   		}	   		
	   }
		return null;		
	}

	public static function control_foto($tipo_archivo)
	{		
		//Control de extencion
		if ($tipo_archivo == "image/jpg" ){
	        $tipo_archivo = "jpg";
		}else if( $tipo_archivo == "image/png"){
		    $tipo_archivo = "png";
		}else if( $tipo_archivo == "image/jpeg"){
		    $tipo_archivo = "jpg";
		}else if ($tipo_archivo == "image/gif" ){
		    $tipo_archivo = "gif";
		}else{
			$tipo_archivo ="";
			echo "<script language='JavaScript'>alert('La extencion del archivo no es valida.');</script>";
		}

		return $tipo_archivo;

	}
	
	public static function control_documento($tipo_archivo)
	{		
		//Control de extencion
		if ($tipo_archivo == "application/pdf" ){
	        $tipo_archivo = "pdf";
		}else if( $tipo_archivo == "binary/octet-stream"){
			echo "hola";
		    $tipo_archivo = "pdf";
		}else if( $tipo_archivo == "application/msword"){
		    $tipo_archivo = "doc";		    
		}else if( $tipo_archivo == "application/vnd.openxmlformats-officedocument.wordprocessingml.document"){
		    $tipo_archivo = "docx";
		}else if ($tipo_archivo == "text/plain" ){
		    $tipo_archivo = "txt";
		}else{
			
			echo "<script language='JavaScript'>alert('xxxLa extencion del archivo no es valida ".$tipo_archivo."');</script>";
			echo $tipo_archivo;
			$tipo_archivo ="";
			exit();
		}

		return $tipo_archivo;

	}

	public static function guardar_archivo($archivo,$ruta,$nombre,$tipo_archivo)
	{
		$nombre .= ".".ManejoArchivos::control_foto($tipo_archivo);		

		if(move_uploaded_file($archivo, $ruta.$nombre))
		{
			echo "<script language='JavaScript'>alert('El archivo se guardo correctamente.');</script>";
			return true;
		}else{
			echo "<script language='JavaScript'>alert('Ocurrio un problema al guardar el archivo.');</script>";
			return false;
		}
	}
	
	public static function guardar_documento($archivo,$ruta,$nombre,$tipo_archivo)
	{
		$nombre .= ".".ManejoArchivos::control_documento($tipo_archivo);		

		if(move_uploaded_file($archivo, $ruta.$nombre))
		{			
			return true;
		}else{			
			return false;
		}
	}

	public static function borrar_archivo($nombre,$ruta,$ruta_disco)
	{
		$archivo_a_borrar ="";
		$archivo_a_borrar = ManejoArchivos::existe_foto($nombre,$ruta);
		if($archivo_a_borrar != "")
		{
			$name = self::getName($archivo_a_borrar);
			$file = $ruta_disco . $name;
			//var_dump($file);die();
		   	if (unlink($file))
			{	
				return true;
			}else{
				return false;
			}	  		
		}else{
			return false;
		}
	}

	public static function boton_editar_foto($nombre, $ruta_relativa, $ancho, $alto , $ruta_disco)
	{
		//var_dump($nombre,$ruta_relativa);die();
		if(ManejoArchivos::existe_foto($nombre,$ruta_relativa) != Config::get('constants.url_no_foto'))
		{
			$boton_editar_foto = '<input class="btn btn-default" name="txt_foto_editar" value="Editar foto"  type="button" class="boton" '; 
			$boton_editar_foto .= 'onClick="ventanaXY(200, 200, '.$ancho.', '.$alto.',';
			$boton_editar_foto .= "'/adm/editar_foto?nombre=". $nombre . "&ruta=" . $ruta_relativa."&ruta_disco=".$ruta_disco."&txt_titulo=Edición de fotografia' ,'')";
			$boton_editar_foto .= '">';
		}else{
			$boton_editar_foto = '<input class="btn btn-default" name="txt_foto_editar" value="Crear foto"  type="button" class="boton" '; 
			$boton_editar_foto .= 'onClick="ventanaXY(200, 200,'.$ancho.','.$alto.',';
			$boton_editar_foto .= "'/adm/editar_foto?nombre=". $nombre . "&ruta=" . $ruta_relativa ."&ruta_disco=".$ruta_disco."&txt_titulo=Creación de fotografia' ,'')";
			$boton_editar_foto .= '">';
		}

		return $boton_editar_foto;
	}
	
	public static function boton_editar_archivo($nombre, $ruta_relativa, $ancho, $alto , $ruta_disco)
	{

		if(ManejoArchivos::existe_documento($nombre,$ruta_disco) != "")
		{
			$boton_editar_foto = '<input class="btn btn-default" name="txt_foto_editar" value="Editar archivo"  type="button" class="boton" '; 
			$boton_editar_foto .= 'onClick="ventanaXY(200, 200, '.$ancho.', '.$alto.',';
			$boton_editar_foto .= "'controls/archivos/archivo.php?nombre=". $nombre . "&ruta=" . $ruta_relativa."&ruta_disco=".$ruta_disco."&txt_titulo=Edición de archivo' ,'')";
			$boton_editar_foto .= '">';
		}else{
			$boton_editar_foto = '<input class="btn btn-default" name="txt_foto_editar" value="Crear archivo"  type="button" class="boton" '; 
			$boton_editar_foto .= 'onClick="ventanaXY(200, 200,'.$ancho.','.$alto.',';
			$boton_editar_foto .= "'controls/archivos/archivo.php?nombre=". $nombre . "&ruta=" . $ruta_relativa ."&ruta_disco=".$ruta_disco."&txt_titulo=Creación de archivo' ,'')";
			$boton_editar_foto .= '">';
		}

		return $boton_editar_foto;
	}

	public static function existPhoto($foto)
	{
		return $foto != Config::get('constants.url_no_foto');
	}

	public static function getName($foto)
	{
		$fotoUrl = explode("/", $foto);
		return ($fotoUrl[count($fotoUrl)-1]);

	}



}