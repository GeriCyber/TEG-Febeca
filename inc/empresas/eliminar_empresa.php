<?php
	$id_sucursal = $_POST['id_sucursal'];
    
    require_once '../funciones_bd.php';
    $db = new funciones_BD();

	if($db->eliminar_sucursal($id_sucursal))
    {
        $exito = urlencode("Se elimino la empresa");
        header("Location:../../empresas.php?exito=".$exito);
        die;
    }
    else
    {
        $error = urlencode("No se pudo eliminar la empresa");
        header("Location:../../empresas.php?error=".$error);
        die;
    }
?>