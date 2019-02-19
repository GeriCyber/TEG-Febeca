<?php
	session_start();
	require_once '../funciones_bd.php';
	$db = new funciones_BD();

	$fecha = date("d-m-Y g:i A");
	$usuario = $_SESSION["nombre"].' '.$_SESSION["apellido"];
	$id_sucursal = $_SESSION["id_sucursal"];
	$empresa = $db->GetEmpresaName($id_sucursal);
	$id_sucursal = $_POST['id_sucursal'];
	$descripcion = $_POST['descripcion'];
	
	if($db->registrar_categoria($id_sucursal, $descripcion))
	{
		//Registrando la accion
		$db->RegisterActivity($usuario, $empresa, $descripcion, $fecha, 'Agregó una categoría');

		$exito = urlencode("Categoría agregada");
	    header("Location:../../categorias.php?exito=".$exito);
	    die;
	}
	else
	{
		$error = urlencode("No se pudo agregar categoría");
	    header("Location:../../categorias.php?error=".$error);
	    die;
	}
	
?>