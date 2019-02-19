<?php
	session_start();
    require_once '../funciones_bd.php';
    $db = new funciones_BD();

    $fecha = date("d-m-Y g:i A");
    $usuario = $_SESSION["nombre"].' '.$_SESSION["apellido"];
    $id_empresa_user = $_SESSION["id_sucursal"];
    $empresa = $db->GetEmpresaName($id_empresa_user);
	$id_categoria = $_POST['id_categoria'];
	$nombre = $db->GetCategoryName($id_categoria);
	
	if($db->eliminar_categoria($id_categoria))
	{
		//Eliminando la asignacion de los videos asociados a esa categoria
		$total = $db->TotalAsignacionesVideoPorCategoria($id_categoria);
    	for ($i = 0; $i < $total; $i++) 
    		$db->eliminar_asignacion_video_por_categoria($id_categoria);

    	//Eliminando la asignacion de los documentos asociados a esa categoria
    	$total = $db->TotalAsignacionesDocumentoPorCategoria($id_categoria);
    	for ($i = 0; $i < $total; $i++) 
    		$db->eliminar_asignacion_documento_por_categoria($id_categoria);

    	//Registrando la accion
        $db->RegisterActivity($usuario, $empresa, $nombre, $fecha, 'Eliminó una categoría');

		$exito = urlencode("Se elimino la categoría");
	    header("Location:../../categorias.php?exito=".$exito);
	    die;
	}
	else
	{
		$error = urlencode("No se pudo eliminar la categoría");
	    header("Location:../../categorias.php?error=".$error);
	    die;
	}
	
?>