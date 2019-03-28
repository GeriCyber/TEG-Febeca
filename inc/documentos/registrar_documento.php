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

	if ($db->isDocumentExist($nombre))
	{
		$error = urlencode("Un documento con ese nombre ya existe");
	    header("Location:../../documentos.php?error=".$error);
	    die;
	}
	else
	{
	    if(!$db->registrar_documento($nombre, $descripcion, $archivo, $checkbox_etiqueta, $fecha_caduc, $id_usuario))
		{
			$error = urlencode("No se pudo agregar el documento");
		    header("Location:../../documentos.php?error=".$error);
		    die;
		}
		else
		{
			//Registrando la accion
			$db->RegisterActivity($usuario, $empresa, $nombre, $fecha, 'Agregó un documento');

			$exito = urlencode("Documento agregado");
		    header("Location:../../documentos.php?exito=".$exito);
		    die;
		}
	}

?>