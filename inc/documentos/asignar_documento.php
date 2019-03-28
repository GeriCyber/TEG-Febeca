<?php
	session_start();
	require_once '../funciones_bd.php';
	$db = new funciones_BD();

	$fecha = date("d-m-Y g:i A");
	$usuario = $_SESSION["nombre"].' '.$_SESSION["apellido"];
	$id_sucursal = $_SESSION["id_sucursal"];
	$empresa = $db->GetEmpresaName($id_sucursal);
	$id_documento = $_POST['id_documento'];
	$nombre = $db->GetDoc($id_documento);
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
		
		$db->actualizar_documento($id_documento, $checkbox_etiqueta, $fecha_caduc, $id_usuario);
	}
	
	if(!$db->isDocumentoAsignado($id_documento))
	{
		for ($i = 0; $i < count($categorias); $i++) 
        {
        	$id_categoria = $categorias[$i];
        	$id_empresa = $db->GetEmpresaID($id_categoria);
     		if(!$db->asignar_documento($id_empresa, $id_documento, $id_categoria))
     			$error = urlencode("No se pudo asignar");
        }
    }
    else
    {
    	//eliminando la asigacion anterior
    	$total = $db->TotalAsignacionesDocumento($id_documento);
    	for ($i = 0; $i < $total; $i++) 
    		$db->eliminar_asignacion_documento($id_documento);

    	//Asignando las nuevas empresas y categorias
    	for ($i = 0; $i < count($categorias); $i++) 
        {
        	$id_categoria = $categorias[$i];
        	$id_empresa = $db->GetEmpresaID($id_categoria);
     		if(!$db->asignar_documento($id_empresa, $id_documento, $id_categoria))
     			$error = urlencode("No se pudo asignar");
        }
    }

    if(empty($error))
    {
    	//Registrando la accion
		$db->RegisterActivity($usuario, $empresa, $nombre, $fecha, 'Asignó un documento');

    	$exito = urlencode("Documento asignado");
	    header("Location:../../documentos.php?exito=".$exito);
	    die;
    }
    else
    {
	    header("Location:../../documentos.php?error=".$error);
	    die;
    }
?>