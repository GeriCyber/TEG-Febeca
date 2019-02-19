<?php
    session_start();
    require_once 'funciones_bd.php';
    $db = new funciones_BD();
    $fecha = date("d-m-Y g:i A");
    $usuario = $_SESSION["nombre"].' '.$_SESSION["apellido"];
    $id_sucursal = $_SESSION["id_sucursal"];
    $empresa = $db->GetEmpresaName($id_sucursal);
    $doc_caducados = $db->ElementosCaducados('documentos', $eliminar=true);
    $vid_caducados = $db->ElementosCaducados('videos', $eliminar=true);
    $error="";
    $warning="";

    //Si hay documentos caducados se eliminan
    if(count($doc_caducados) > 0)
    {
        foreach ($doc_caducados as $documento) 
        {
            $id = $documento['id_documento'];
            $nombre = $documento['nombre'];
            if($db->isDocumentExist($nombre))
            {
                $db->eliminar_documento($id);
                $eliminar = '../../uploads/'.$nombre;
                chmod($eliminar, 0777);

                if(!empty($eliminar))
                    unlink($eliminar);

                //Registrando la accion
        		$db->RegisterActivity($usuario, $empresa, $nombre, $fecha, 'Eliminó un documento');

                //Eliminando la asignacion del documento
                $total = $db->TotalAsignacionesDocumento($id);
                for ($i = 0; $i < $total; $i++) 
                    $db->eliminar_asignacion_documento($id);
            }
            else
                $error .= 'No se encontro el documento: "'.$nombre.'" ';
        }
    }

    //Si hay videos caducados se eliminan
    if(count($vid_caducados) > 0)
    {
        foreach ($vid_caducados as $video) 
        {
            $id = $video['id_video'];
            $nombre = $video['nombre'];
            
            if($db->isVideoExist($nombre))
            {
                $db->eliminar_video($id);
                $eliminar = '../../uploads/'.$nombre;
                chmod($eliminar, 0777);

                if(!empty($eliminar))
                    unlink($eliminar);

                //Registrando la accion
        		$db->RegisterActivity($usuario, $empresa, $nombre, $fecha, 'Eliminó un vídeo');

                //Eliminando la asignacion del video
                $total = $db->TotalAsignacionesVideo($id);
                for ($i = 0; $i < $total; $i++) 
                    $db->eliminar_asignacion_video($id);
            }
            else
                $error .= 'No se encontro el video: "'.$nombre.'" ';
        }
    }

    //Verificando si hubieron errores eliminando los elementos
    if(!empty($error))
    {
        $warning .= urlencode("Hubieron algunos errores: ");
        header("Location:eliminar_caducados.php?error=".$warning.$error);
        die;
    }
    else
    {
        $exito = urlencode("Se eliminaron los elementos caducados");
        header("Location:eliminar_caducados.php?exito=".$exito);
        die;
    }
?>