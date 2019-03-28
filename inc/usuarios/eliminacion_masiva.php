<?php
    session_start();
    require_once '../funciones_bd.php';
    $db = new funciones_BD();

    $fecha = date("d-m-Y g:i A");
    $usuario = $_SESSION["nombre"].' '.$_SESSION["apellido"];
    $id_sucursal_user = $_SESSION["id_sucursal"];
    $empresa = $db->GetEmpresaName($id_sucursal_user);
    $id = !empty($_POST['id']) ? $_POST['id'] : 0;
    $content = !empty($_POST['usuariosJSON']) ? $_POST['usuariosJSON'] : "";
    $usuarios = json_decode($content, true);
    $numUsuarios = count($usuarios);
    $error="";
    $warning="";

    if($numUsuarios == 0)
        $error .= 'No se seleccionaron usuarios';
    else
    {
        for ($i = 0; $i < $numUsuarios; $i++) 
        {
            $id_usuario = $usuarios[$i];
            $registro = $db->GetUserFullName($id_usuario);
            if($db->isUserNameExist($id_usuario))
            {
                $db->eliminar_usuario($id_usuario);

                //Registrando la accion
                $db->RegisterActivity($usuario, $empresa, $registro, $fecha, 'Eliminó un usuario');
            }
            else
                $error .= 'No se encontro el usuario: "'.$id_usuario.'" ';
        }
    }

    //Verificando si hubieron errores eliminando a lo usuarios
    if(!empty($error))
    {
        $warning .= urlencode("Hubieron algunos errores: ");
        header("Location:../../usuarios.php?error=".$warning.$error);
        die;
    }
    else
    {
        $exito = urlencode("Se eliminaron los usuarios");
        header("Location:../../usuarios.php?exito=".$exito);
        die;
    }

?>
