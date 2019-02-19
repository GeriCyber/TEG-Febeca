<?php
	session_start();
    require_once '../funciones_bd.php';
    $db = new funciones_BD();

    $fecha = date("d-m-Y g:i A");
    $usuario = $_SESSION["nombre"].' '.$_SESSION["apellido"];
    $id_sucursal = $_SESSION["id_sucursal"];
    $empresa = $db->GetEmpresaName($id_sucursal);
	$id_video = $_POST['id_video'];
    $nombre = $db->GetVideo($id_video);
	$id_usuario = $_SESSION['id_usuario'];
	$fecha_caduc = $_POST['fecha_caduc'];
	$checkbox_etiqueta = '';
	$cambiar_fecha = $_POST['cambiar_fecha'];
	$content = !empty($_POST['cats']) ? $_POST['cats'] : "";
    $categorias = json_decode($content, true);
	$error = '';

	if($cambiar_fecha == 'Si')
	{
		if(empty($fecha_caduc)) 
		{
			$checkbox_etiqueta = 'No';
			$fecha_caduc = 'No caduca';
		}
		else
			$checkbox_etiqueta = 'Si';

		$db->actualizar_video($id_video, $checkbox_etiqueta, $fecha_caduc, $id_usuario);
	}

	if(!$db->isVideoAsignado($id_video))
	{
		for ($i = 0; $i < count($categorias); $i++) 
        {
        	$id_categoria = $categorias[$i];
        	$id_empresa = $db->GetEmpresaID($id_categoria);
     		if(!$db->asignar_video($id_empresa, $id_video, $id_categoria))
     			$error = urlencode("Hubo un error al asignar el vídeo");
        }
    }
    else
    {
    	//eliminando la asigacion anterior
    	$total = $db->TotalAsignacionesVideo($id_video);
    	for ($i = 0; $i < $total; $i++) 
    		$db->eliminar_asignacion_video($id_video);

    	//Asignando las nuevas empresas y categorias
    	for ($i = 0; $i < count($categorias); $i++) 
        {
        	$id_categoria = $categorias[$i];
        	$id_empresa = $db->GetEmpresaID($id_categoria);
     		if(!$db->asignar_video($id_empresa, $id_video, $id_categoria))
     			$error = urlencode("Hubo un error al asignar el vídeo");
        }
    }
    
    if(empty($error))
    {
        //Registrando la accion
        $db->RegisterActivity($usuario, $empresa, $nombre, $fecha, 'Asignó un vídeo');

    	$exito = urlencode("Vídeo asignado");
	    header("Location:../../videos.php?exito=".$exito);
	    die;
    }
    else
    {
	    header("Location:../../videos.php?error=".$error);
	    die;
    }
?>