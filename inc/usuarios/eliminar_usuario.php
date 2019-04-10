<?php
    session_start();
    require_once '../funciones_bd.php';
    $db = new funciones_BD();

    $fecha = date("d-m-Y g:i A");
    $usuario = $_SESSION["nombre"].' '.$_SESSION["apellido"];
    $id_sucursal_user = $_SESSION["id_sucursal"];
    $empresa = $db->GetEmpresaName($id_sucursal_user);
	$id = !empty($_POST['id']) ? $_POST['id'] : 0;
	$id_usuario = !empty($_POST['id_usuario']) ? $_POST['id_usuario'] : "";
    $registro = $db->GetUserFullName($id_usuario);

	if($db->eliminar_usuario($id_usuario))
    {
        //Registrando la accion
        $db->RegisterActivity($usuario, $empresa, $registro, $fecha, 'Eliminó un usuario');

        $exito = urlencode("Se eliminó el usuario");
        header("Location:../../usuarios.php?exito=".$exito);
        die;
    }
    else
    {
        $error = urlencode("No se pudo eliminar el usuario");
        header("Location:../../usuarios.php?error=".$error);
        die;
    }
?>
