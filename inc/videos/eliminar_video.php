<?php
    session_start();
    require_once '../funciones_bd.php';
    $db = new funciones_BD();

    $fecha = date("d-m-Y g:i A");
    $usuario = $_SESSION["nombre"].' '.$_SESSION["apellido"];
    $id_sucursal = $_SESSION["id_sucursal"];
    $empresa = $db->GetEmpresaName($id_sucursal);
    $id_video = $_POST['id_video'];
    $name = $db->GetVideoName($id_video);
    $registro = $db->GetVideo($id_video);
    $eliminar = '../../uploads/'.$name;
    chmod($eliminar, 0777);

    if($db->eliminar_video($id_video))
    {
        if(!empty($eliminar))
            unlink($eliminar);

        //Eliminando la asignacion del video
        $total = $db->TotalAsignacionesVideo($id_video);
        for ($i = 0; $i < $total; $i++) 
            $db->eliminar_asignacion_video($id_video);

        //Registrando la accion
        $db->RegisterActivity($usuario, $empresa, $registro, $fecha, 'Eliminó un vídeo');

        $exito = urlencode("Se eliminó el vídeo");
        header("Location:../../videos.php?exito=".$exito);
        die;
    }
    else
    {
        $error = urlencode("No se pudo eliminar el vídeo");
        header("Location:../../videos.php?error=".$error);
        die;
    }
?>