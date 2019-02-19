<?php
	session_start();
	require_once '../funciones_bd.php';
	$db = new funciones_BD();

	$fecha = date("d-m-Y g:i A");
	$usuario = $_SESSION["nombre"].' '.$_SESSION["apellido"];
	$id_sucursal = $_SESSION["id_sucursal"];
	$empresa = $db->GetEmpresaName($id_sucursal);
	$nombre = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];
	$id_usuario = $_SESSION["id_usuario"];
	$checkbox_etiqueta = 'No';
	$fecha_caduc = 'No caduca';
	//Obtener archivo
	$archivo = $_FILES['archivo']['error'] == 0 ? $_FILES['archivo'] : "";	

	if ($db->isVideoExist($nombre))
	{
		$error = urlencode("Un vídeo con ese nombre ya existe");
	    header("Location:../../videos.php?error=".$error);
	    die;
	}
	else
	{
	    if(!$db->registrar_video($nombre, $descripcion, $archivo, $checkbox_etiqueta, $fecha_caduc, $id_usuario))
		{
			$error = urlencode("No se pudo agregar el vídeo");
		    header("Location:../../videos.php?error=".$error);
		    die;
		}
		else
		{
			//Registrando la accion
			$db->RegisterActivity($usuario, $empresa, $nombre, $fecha, 'Agregó un vídeo');

			$exito = urlencode("Vídeo agregado");
		    header("Location:../../videos.php?exito=".$exito);
		    die;
		}
	}

?>