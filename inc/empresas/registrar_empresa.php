<?php
	session_start();
	require_once '../funciones_bd.php';
	$db = new funciones_BD();

	$fecha = date("d-m-Y g:i A");
	$usuario = $_SESSION["nombre"].' '.$_SESSION["apellido"];
	$id_sucursal = $_SESSION["id_sucursal"];
	$empresa = $db->GetEmpresaName($id_sucursal);
	$nombre = $_POST['nombre'];
	$direccion = $_POST['direccion'];
	$telefono = $_POST['telefono'];
	$correo = $_POST['correo'];
	$estatus = 1;
	$archivo = $_FILES['archivo']['error'] == 0 ? $_FILES['archivo'] : "";
	
	if (!$db->isempresaexist($nombre))
	{
		if($db->registrar_sucursal($nombre, $direccion, $telefono, $correo, $estatus, $archivo))
		{
			//Registrando la accion
			$db->RegisterActivity($usuario, $empresa, $nombre, $fecha, 'Agregó una Empresa');

			$exito = urlencode("Empresa agregada");
		    header("Location:../../empresas.php?exito=".$exito);
		    die;
		}
		else
		{
			$error = urlencode("No se pudo agregar empresa");
		    header("Location:../../empresas.php?error=".$error);
		    die;
		}
	}
	else
	{
		$error = urlencode("La empresa ya existe");
	    header("Location:../../empresas.php?error=".$error);
	    die;
	}
	
?>