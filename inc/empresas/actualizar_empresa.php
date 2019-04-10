<?php
	session_start();
	require_once '../funciones_bd.php';
	$db = new funciones_BD();

	$fecha = date("d-m-Y g:i A");
	$usuario = $_SESSION["nombre"].' '.$_SESSION["apellido"];
	$id_empresa_user = $_SESSION["id_sucursal"];
	$empresa = $db->GetEmpresaName($id_empresa_user);
	$id_sucursal = $_POST['id_sucursal'];
	$nombre = $_POST['nombre'];
	$direccion = $_POST['direccion'];
	$telefono = $_POST['telefono'];
	$correo = $_POST['correo'];
	$archivo = $_FILES['archivo']['error'] == 0 ? $_FILES['archivo'] : "";

	if($db->actualizar_sucursal($id_sucursal, $nombre, $direccion, $telefono, $correo, $archivo))
	{
		//Registrando la accion
		$db->RegisterActivity($usuario, $empresa, $nombre, $fecha, 'Modificó una Empresa');

		$exito = urlencode("Se modificó la empresa");
        header("Location:../../empresas.php?exito=".$exito);
        die;
	}
	else
    {
        $error = urlencode("No se pudo modificar la empresa");
        header("Location:../../empresas.php?error=".$error);
        die;
    }
/*	else
	{
		$error = urlencode("La empresa ya existe");
	    header("Location:../../empresas.php?error=".$error);
	    die;
	}*/
	
?>