<?php
	session_start();
	require_once '../funciones_bd.php';
	$db = new funciones_BD();

	$fecha = date("d-m-Y g:i A");
	$usuario = $_SESSION["nombre"].' '.$_SESSION["apellido"];
	$id_empresa_user = $_SESSION["id_sucursal"];
	$empresa = $db->GetEmpresaName($id_empresa_user);
	$id_categoria = $_POST['id_categoria'];
	$descripcion = $_POST['descripcion'];

	require_once '../funciones_bd.php';
	$db = new funciones_BD();
	

	if($db->modificar_categoria($id_categoria, $descripcion))
	{
		//Registrando la accion
		$db->RegisterActivity($usuario, $empresa, $descripcion, $fecha, 'Modificó una categoría');

		$exito = urlencode("Se modifico la categoría");
	    header("Location:../../categorias.php?exito=".$exito);
	    die;
	}
	else
	{
		$error = urlencode("No se pudo modificar la categoría");
	    header("Location:../../categorias.php?error=".$error);
	    die;
	}
	
?>