<?php
	session_start();
	$clave_antigua = $_POST["clave_antigua"];
	$clave_nueva = $_POST["clave_nueva"];
	$id_usuario = $_SESSION["id_usuario"];
	require_once 'funciones_bd.php';

	$db = new funciones_BD();

	if (!$db->cambiar_clave($id_usuario, $clave_antigua, $clave_nueva))
	{
		$error = urlencode("No se pudo cambiar la Contraseña");
        header("Location:../cambiar_contrasena.php?error=".$error);
        die;
	}
	else
	{
		session_destroy();
		$error = urlencode("Se cambio la Contraseña, inicia sesión nuevamente");
		header("Location: ../index.php?success=".$error);
	}
?>