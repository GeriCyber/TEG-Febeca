<?php
    session_start();
    require_once '../funciones_bd.php';
    $db = new funciones_BD();

    $fecha = date("d-m-Y g:i A");
    $usuario = $_SESSION["nombre"].' '.$_SESSION["apellido"];
    $id_sucursal_user = $_SESSION["id_sucursal"];
    $empresa = $db->GetEmpresaName($id_sucursal_user);
    $id_usuario = !empty($_POST['id_usuario']) ? $_POST['id_usuario'] : 0;
    $id_rol = !empty($_POST['id_rol']) ? $_POST['id_rol'] : 0;
    $nombre = !empty($_POST['nombre']) ? $_POST['nombre'] : 'null';
    $clave = !empty($_POST['clave']) ? $_POST['clave'] : 0;
    $apellido = !empty($_POST['apellido']) ? $_POST['apellido'] : 'null';
    $cedula = !empty($_POST['cedula']) ? $_POST['cedula'] : 'null';
    $telefono = !empty($_POST['telefono']) ? $_POST['telefono'] : 0;
    $correo = !empty($_POST['correo']) ? $_POST['correo'] : 0;
    $taller = !empty($_POST['taller']) ? $_POST['taller'] : 0;
    $id_sucursal = $_POST['id_sucursal'];
    $android = !empty($_POST['android']) ? $_POST['android'] : false;
    $registro = $nombre.' '.$apellido;

    if($db->actualizar_usuario($id_sucursal, $id_rol, $nombre, $apellido, $cedula, $telefono, $correo, $taller, $id_usuario, $clave))
    {
        //Registrando la accion
        $db->RegisterActivity($usuario, $empresa, $registro, $fecha, 'Modificó un usuario');

        $exito = urlencode("Se modificó el usuario");
        header("Location:../../usuarios.php?exito=".$exito);
        die;
    }
    else
    {
        $error = urlencode("No se pudo modificar el usuario");
        header("Location:../../usuarios.php?error=".$error);
        die;
    }

?>
<?php 