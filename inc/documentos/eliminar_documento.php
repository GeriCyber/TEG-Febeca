<?php
    session_start();
    require_once '../funciones_bd.php';
    $db = new funciones_BD();

    $fecha = date("d-m-Y g:i A");
    $usuario = $_SESSION["nombre"].' '.$_SESSION["apellido"];
    $id_sucursal = $_SESSION["id_sucursal"];
    $empresa = $db->GetEmpresaName($id_sucursal);
    $id_documento = $_POST['id_documento'];
    $name = $db->GetDocName($id_documento);
    $registro = $db->GetDoc($id_documento);
    $eliminar = '../../uploads/'.$name;
    chmod($eliminar, 0777);

    if($db->eliminar_documento($id_documento))
    {
        if(!empty($eliminar))
            unlink($eliminar);

        //Eliminando la asignacion del documento
        $total = $db->TotalAsignacionesDocumento($id_documento);
        for ($i = 0; $i < $total; $i++) 
            $db->eliminar_asignacion_documento($id_documento);

        //Registrando la accion
        $db->RegisterActivity($usuario, $empresa, $registro, $fecha, 'Eliminó un documento');

        $exito = urlencode("Se eliminó el documento");
        header("Location:../../documentos.php?exito=".$exito);
        die;
    }
    else
    {
        $error = urlencode("No se pudo eliminar el vídeo");
        header("Location:../../documentos.php?error=".$error);
        die;
    }
?>