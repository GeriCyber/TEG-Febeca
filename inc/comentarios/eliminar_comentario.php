<?php
	session_start();
    require_once '../funciones_bd.php';
    $db = new funciones_BD();

    $fecha = date("d-m-Y g:i A");
    $usuario = $_SESSION["nombre"].' '.$_SESSION["apellido"];
    $id_empresa_user = $_SESSION["id_sucursal"];
    $empresa = $db->GetEmpresaName($id_empresa_user);
	$id_comentario = $_POST['id_comentario'];
	$comentario = $db->GetComentario($id_comentario);
	
	if($db->eliminar_comentario($id_comentario))
	{
		//Registrando la accion
        $db->RegisterActivity($usuario, $empresa, $comentario, $fecha, 'Eliminó una comentario');

		$exito = urlencode("Se elimino el comentario");
	    header("Location:../../valoraciones.php?exito=".$exito);
	    die;
	}
	else
	{
		$error = urlencode("No se pudo eliminar el comentario");
	    header("Location:../../valoraciones.php?error=".$error);
	    die;
	}
	
?>